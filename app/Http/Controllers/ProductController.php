<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\WishlistItem;
use App\Services\JewelleryPricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show(Product $product, JewelleryPricingService $pricingService)
    {
        $viewKey = 'product_viewed_' . $product->product_id;
        if (!request()->session()->has($viewKey)) {
            ProductView::create([
                'product_id' => $product->product_id,
                'user_id' => Auth::id(),
                'session_id' => request()->session()->getId(),
                'viewed_at' => now(),
            ]);

            request()->session()->put($viewKey, true);
        }

        $relations = [
            'category',
            'jewellery.type',
            'gem.gemType',
            'gem.zodiacSigns',
            'gem.birthstoneMonths',
            'collection',
            'reviews' => fn ($query) => $query->where('status', 'approved')->latest()->with('orderItem'),
        ];

        if (Schema::hasTable('product_360_previews')) {
            $relations[] = 'preview360';
        }

        $product->load($relations);

        $reviews = $product->reviews;
        $reviewCount = $reviews->count();
        $averageRating = $reviewCount ? round($reviews->avg('rating'), 2) : 0;
        $ratingDistribution = collect(range(5, 1))
            ->mapWithKeys(fn ($rating) => [$rating => $reviews->where('rating', $rating)->count()]);

        $productType = $product->gem ? 'Gemstone' : ($product->jewellery ? 'Jewellery' : ($product->collection ? 'Collection' : 'Product'));
        $metaParts = collect([$productType]);

        if ($product->gem) {
            $metaParts->push($product->gem->gemType?->name, $product->gem->color, $product->gem->shape);
        }

        if ($product->jewellery) {
            $metaParts->push(
                $product->jewellery->type?->name,
                $product->jewellery->metal,
                $product->jewellery->metal_purity,
                $product->jewellery->occasion
            );
        }

        if ($product->collection) {
            $metaParts->push(
                'Collection',
                $product->collection->metal,
                $product->collection->occasion,
                $product->collection->gemstone
            );
        }

        $attributes = $this->productAttributes($product);
        $pricingSummary = $product->jewellery ? $pricingService->breakdown($product) : null;
        $sizeLabel = trim((string) ($product->size_label ?? ''));
        $sizeOptions = $this->parseSizeOptions($product->size_options ?? null);
        $stock = max(0, (int) ($product->stock ?? 0));
        $stockStatus = $stock <= 0 ? 'out of stock' : ($stock <= 5 ? 'critical' : 'in-stock');
        $stockLabel = $stock <= 0 ? 'out of stock' : ($stock <= 5 ? 'low stock' : 'in-stock');
        $isInCart = Auth::check()
            && Auth::user()->role === 'customer'
            && CartItem::query()
                ->where('product_id', $product->product_id)
                ->whereHas('cart', fn ($query) => $query->where('user_id', Auth::id()))
                ->exists();
        $cartItemId = Auth::check()
            && Auth::user()->role === 'customer'
            ? CartItem::query()
                ->where('product_id', $product->product_id)
                ->whereHas('cart', fn ($query) => $query->where('user_id', Auth::id()))
                ->value('id')
            : null;
        $isWishlisted = Auth::check()
            && Auth::user()->role === 'customer'
            && WishlistItem::query()
                ->where('user_id', Auth::id())
                ->where('product_id', $product->product_id)
                ->exists();
        $wishlistItemId = Auth::check()
            && Auth::user()->role === 'customer'
            ? WishlistItem::query()
                ->where('user_id', Auth::id())
                ->where('product_id', $product->product_id)
                ->value('id')
            : null;
        $reviewEligibility = $this->resolveReviewEligibility($product);
        $preview360Images = $product->jewellery && $product->preview360
            ? $product->preview360->imageUrls()
            : [];

        return view('single_product', [
            'product' => $product,
            'productType' => $productType,
            'metaLine' => $metaParts->filter()->implode(' / '),
            'imageUrl' => $product->image
                ? asset('images/Product/'.$product->image)
                : asset('images/placeholders/notavailable.png'),
            'reviews' => $reviews,
            'reviewCount' => $reviewCount,
            'averageRating' => $averageRating,
            'ratingDistribution' => $ratingDistribution,
            'attributes' => $attributes,
            'pricingSummary' => $pricingSummary,
            'sizeLabel' => $sizeLabel,
            'sizeOptions' => $sizeOptions,
            'stock' => $stock,
            'stockStatus' => $stockStatus,
            'stockLabel' => $stockLabel,
            'isInCart' => $isInCart,
            'cartItemId' => $cartItemId,
            'isWishlisted' => $isWishlisted,
            'wishlistItemId' => $wishlistItemId,
            'canReview' => $reviewEligibility['can_review'],
            'reviewEligibilityMessage' => $reviewEligibility['message'],
            'eligibleOrderItemId' => $reviewEligibility['order_item_id'],
            'preview360Images' => $preview360Images,
            'has360Preview' => !empty($preview360Images),
        ]);
    }

    public function storeReview(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('signin')
                ->with('auth_error', 'Please sign in to leave a review.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'review' => ['required', 'string', 'min:5', 'max:2000'],
            'order_item_id' => ['required', 'integer', 'exists:order_items,id'],
        ]);

        $orderItem = OrderItem::query()
            ->with('order')
            ->whereKey($validated['order_item_id'])
            ->where('product_id', $product->product_id)
            ->whereHas('order', fn ($query) => $query
                ->where('user_id', Auth::id())
                ->where('status', '!=', 'Cancelled'))
            ->first();

        if (!$orderItem) {
            return redirect()
                ->route('products.show', $product)
                ->with('review_error', 'Only customers who purchased this item can leave a review.');
        }

        if ($orderItem->review()->exists()) {
            return redirect()
                ->route('products.show', $product)
                ->with('review_error', 'You have already reviewed this purchase.');
        }

        $product->reviews()->create([
            'user_id' => Auth::id(),
            'order_item_id' => $orderItem->id,
            'name' => Str::title($validated['name']),
            'email' => $validated['email'],
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => 'approved',
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('review_success', 'Thank you. Your review has been added.');
    }

    private function resolveReviewEligibility(Product $product): array
    {
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return [
                'can_review' => false,
                'order_item_id' => null,
                'message' => 'Please sign in to leave a review.',
            ];
        }

        $purchasedItems = OrderItem::query()
            ->select('order_items.*')
            ->with('order')
            ->where('order_items.product_id', $product->product_id)
            ->whereHas('order', fn ($query) => $query
                ->where('user_id', Auth::id())
                ->where('status', '!=', 'Cancelled'))
            ->orderByDesc('order_items.id')
            ->get();

        if ($purchasedItems->isEmpty()) {
            return [
                'can_review' => false,
                'order_item_id' => null,
                'message' => 'Only customers who purchased this item can leave a review.',
            ];
        }

        $eligibleOrderItem = $purchasedItems->first(fn (OrderItem $item) => !$item->review()->exists());

        if (!$eligibleOrderItem) {
            return [
                'can_review' => false,
                'order_item_id' => null,
                'message' => 'You have already reviewed this purchase.',
            ];
        }

        return [
            'can_review' => true,
            'order_item_id' => $eligibleOrderItem->id,
            'message' => null,
        ];
    }

    private function productAttributes(Product $product): array
    {
        if ($product->gem) {
            $zodiacSigns = $product->gem->zodiacSigns->pluck('sign_name')->filter()->values();
            $birthstoneMonths = $product->gem->birthstoneMonths->pluck('month_name')->filter()->values();

            return [
                'Gem Type' => $product->gem->gemType?->name,
                'Cut' => $product->gem->cut ?? $product->gem->shape,
                'Color' => $product->gem->color,
                'Carat' => $product->gem->carat_weight ? $product->gem->carat_weight.' ct' : null,
                'Zodiac Signs' => $zodiacSigns->isNotEmpty() ? $zodiacSigns->implode(', ') : null,
                'Birthstone Months' => $birthstoneMonths->isNotEmpty() ? $birthstoneMonths->implode(', ') : null,
            ];
        }

        if ($product->jewellery) {
            $attributes = [
                'Jewellery Type' => $product->jewellery->type?->name,
                'Occasion' => $product->jewellery->occasion,
                'Gender' => $product->jewellery->gender,
                'Metal' => $product->jewellery->metal,
                'Metal Purity' => $product->jewellery->metal_purity,
                'Gemstone' => $product->jewellery->gemstone,
                'Metal Weight' => $product->jewellery->metal_weight ? $product->jewellery->metal_weight.' g' : null,
                'Making Charge' => $product->jewellery->making_charge ? 'LKR '.number_format((float) $product->jewellery->making_charge, 2) : null,
                'Wastage' => $product->jewellery->wastage_percent ? $product->jewellery->wastage_percent.'%' : null,
                'Market Factor' => $product->jewellery->market_factor ? number_format((float) $product->jewellery->market_factor, 3) : null,
                'Pricing Mode' => Str::title($product->jewellery->pricing_mode ?? 'dynamic'),
            ];

            $sizeLabel = trim((string) ($product->size_label ?? ''));
            $sizeOptions = $this->parseSizeOptions($product->size_options ?? null);
            if ($sizeLabel !== '') {
                $attributes['Size Label'] = $sizeLabel;
            }
            if (!empty($sizeOptions)) {
                $attributes['Available Sizes'] = implode(', ', $sizeOptions);
            }

            return $attributes;
        }

        if ($product->collection) {
            return [
                'Collection Type' => 'Collection',
                'Occasion' => $product->collection->occasion,
                'Gender' => $product->collection->gender,
                'Metal' => $product->collection->metal,
                'Gemstone' => $product->collection->gemstone,
            ];
        }

        return [];
    }

    private function parseSizeOptions(mixed $value): array
    {
        $parts = preg_split('/\s*,\s*/', trim((string) $value), -1, PREG_SPLIT_NO_EMPTY) ?: [];

        return collect($parts)
            ->map(fn ($part) => trim((string) $part))
            ->filter()
            ->values()
            ->all();
    }
}
