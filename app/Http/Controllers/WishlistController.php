<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use App\Services\JewelleryPricingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(JewelleryPricingService $pricingService)
    {
        $this->assertCustomer();

        $wishlistItems = $this->wishlistQuery()
            ->latest('wishlist_items.created_at')
            ->get()
            ->map(function (WishlistItem $item) use ($pricingService) {
                $product = $item->product;
                $price = $product ? $pricingService->priceForProduct($product, (float) 
                $product->getRawOriginal('price')) : 0;
                $stock = max(0, (int) ($product?->stock ?? 0));

                return [
                    'wishlist_item_id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $product?->name ?? 'Product',
                    'description' => $product?->description,
                    'image' => $product?->image
                        ? asset('images/Product/'.$product->image)
                        : asset('images/placeholders/notavailable.png'),
                    'price' => 'Rs '.number_format($price, 0),
                    'price_value' => $price,
                    'stock' => $stock,
                    'stock_label' => $stock <= 0 ? 'Out of Stock' : ($stock <= 5 ? 'Only ' . $stock . ' left' : 'In Stock'),
                    'stock_status' => $stock <= 0 ? 'out-of-stock' : ($stock <= 5 ? 'critical' : 'in-stock'),
                    'pricing_mode' => $product?->jewellery?->pricing_mode ?? 'static',
                    'targetUrl' => $product ? route('products.show', $product) : '#',
                ];
            })
            ->values();

        return view('customer-account', [
            'activeSection' => 'wishlist',
            'wishlistItems' => $wishlistItems,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->assertCustomer();

        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,product_id'],
        ]);

        $wishlistItem = WishlistItem::query()
            ->where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();

            return back()->with('wishlist_success', 'Removed from wishlist.');
        }

        WishlistItem::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
        ]);

        return back()->with('wishlist_success', 'Added to wishlist.');
    }

    public function destroy(WishlistItem $wishlistItem): RedirectResponse
    {
        $this->assertCustomer();
        $this->assertWishlistOwnership($wishlistItem);

        $wishlistItem->delete();

        return back()->with('wishlist_success', 'Removed from wishlist.');
    }

    private function assertCustomer(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'customer', 403);
    }

    private function assertWishlistOwnership(WishlistItem $wishlistItem): void
    {
        abort_unless((int) $wishlistItem->user_id === (int) Auth::id(), 403);
    }

    private function wishlistQuery()
    {
        return WishlistItem::query()
            ->with(['product.gem.gemType', 'product.gem.zodiacSigns', 'product.gem.birthstoneMonths', 'product.jewellery.type'])
            ->where('user_id', Auth::id());
    }
}
