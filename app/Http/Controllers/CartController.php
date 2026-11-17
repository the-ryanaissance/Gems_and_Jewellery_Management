<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomJewelleryQuotation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SiteNotification;
use App\Services\JewelleryPricingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function __construct(
        private readonly JewelleryPricingService $pricingService,
    ) {
    }

    public function index()
    {
        $this->assertCustomer();
        $cart = $this->loadCart();

        return view('customer-account', array_merge(['activeSection' => 'cart'], $this->cartViewData($cart)));
    }

    public function checkout(Request $request)
    {
        $this->assertCustomer();
        $cart = $this->loadCart();
        $viewData = $this->cartViewData($cart);
        $viewData['quotationCheckout'] = false;
        $quotationCheckout = $request->session()->get('custom_quotation_checkout');

        if (is_array($quotationCheckout) && !empty($quotationCheckout['items'] ?? [])) {
            $items = collect($quotationCheckout['items'])->values()->all();
            $viewData['cartItems'] = $items;
            $viewData['cartSubtotal'] = collect($items)->sum(function (array $item) {
                return ((float) ($item['price'] ?? 0)) * (int) ($item['quantity'] ?? 1);
            });
            $viewData['cartCount'] = collect($items)->sum('quantity');
            $viewData['quotationCheckout'] = true;
        }

        return view('checkout', $viewData);
    }

    public function storeCheckout(Request $request): JsonResponse
    {
        $this->assertCustomer();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:2000'],
            'city' => ['nullable', 'string', 'max:120'],
            'town' => ['nullable', 'string', 'max:120'],
            'province' => ['nullable', Rule::in([
                'Western Province',
                'Central Province',
                'Southern Province',
                'Northern Province',
                'Eastern Province',
                'North Western Province',
                'North Central Province',
                'Uva Province',
                'Sabaragamuwa Province',
            ])],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'shipping_method' => ['required', 'in:standard,express,pickup'],
            'payment_method' => ['required', 'in:card,bank,cod'],
            'cart_items' => ['nullable', 'string'],
        ]);

        $cart = $this->loadCart();
        $cart->loadMissing('items.product');

        $submittedItems = [];
        if (!empty($validated['cart_items'])) {
            $decoded = json_decode($validated['cart_items'], true);
            if (is_array($decoded)) {
                $submittedItems = collect($decoded)->filter(fn ($item) => is_array($item) && !empty($item['product_id'] ?? $item['id'] ?? null))->values()->all();
            }
        }

        $itemsForOrder = !empty($submittedItems) ? $submittedItems : $this->buildCartItems($cart);
        $itemsForOrder = $this->normalizeCheckoutItems($itemsForOrder);

        if (empty($itemsForOrder)) {
            return response()->json(['message' => 'Your cart is empty.'], 422);
        }

        $stockError = $this->checkoutStockError($itemsForOrder);
        if ($stockError) {
            return response()->json(['message' => $stockError], 422);
        }

        $subtotal = collect($itemsForOrder)->sum(function (array $item) {
            return ((float) ($item['price'] ?? 0)) * (int) ($item['quantity'] ?? 1);
        });
        $pickupOnly = $subtotal > 40000;
        $shippingMethod = $pickupOnly ? 'pickup' : $validated['shipping_method'];
        $shippingCost = $pickupOnly ? 0 : match ($shippingMethod) {
            'standard' => 200,
            'express' => 350,
            'pickup' => 0,
            default => 200,
        };
        $total = $subtotal + $shippingCost;
        $depositAmount = $pickupOnly ? round($subtotal * 0.20, 2) : $total;
        $balanceDue = $pickupOnly ? round($subtotal - $depositAmount, 2) : 0;
        $confirmationPayload = [
            'customer' => $validated,
            'items' => $itemsForOrder,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'pickup_only' => $pickupOnly,
            'deposit_amount' => $depositAmount,
            'balance_due' => $balanceDue,
            'shipping_method' => $shippingMethod,
            'payment_method' => $validated['payment_method'],
        ];

        $request->session()->put('checkout_confirmation', $confirmationPayload);

        return response()->json([
            'ok' => true,
            'redirect_url' => route('checkout.confirm'),
        ]);
    }

    public function confirmCheckout(Request $request)
    {
        $this->assertCustomer();
        $confirmation = $request->session()->get('checkout_confirmation');

        if (!is_array($confirmation) || empty($confirmation['items'] ?? [])) {
            return redirect()->route('checkout')->with('checkout_error', 'Please start checkout again.');
        }

        $stockError = $this->checkoutStockError((array) ($confirmation['items'] ?? []));
        if ($stockError) {
            return redirect()->route('checkout')->with('checkout_error', $stockError);
        }

        return view('checkout-confirm', [
            'customer' => $confirmation['customer'] ?? [],
            'items' => $confirmation['items'] ?? [],
            'subtotal' => (float) ($confirmation['subtotal'] ?? 0),
            'shippingCost' => (float) ($confirmation['shipping_cost'] ?? 0),
            'total' => (float) ($confirmation['total'] ?? 0),
            'pickupOnly' => (bool) ($confirmation['pickup_only'] ?? false),
            'depositAmount' => (float) ($confirmation['deposit_amount'] ?? 0),
            'balanceDue' => (float) ($confirmation['balance_due'] ?? 0),
            'shippingMethod' => (string) ($confirmation['shipping_method'] ?? 'standard'),
            'paymentMethod' => (string) ($confirmation['payment_method'] ?? 'card'),
            'quotationCheckout' => (bool) $request->session()->has('custom_quotation_checkout'),
        ]);
    }

    public function finalizeCheckout(Request $request): JsonResponse|RedirectResponse
    {
        $this->assertCustomer();

        $confirmation = $request->session()->get('checkout_confirmation');
        if (!is_array($confirmation) || empty($confirmation['items'] ?? [])) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Checkout session expired. Please start again.'], 422);
            }

            return redirect()->route('checkout')->with('checkout_error', 'Checkout session expired. Please start again.');
        }

        $validated = [
            'first_name' => (string) data_get($confirmation, 'customer.first_name', ''),
            'last_name' => (string) data_get($confirmation, 'customer.last_name', ''),
            'email' => (string) data_get($confirmation, 'customer.email', ''),
            'phone' => data_get($confirmation, 'customer.phone'),
            'address' => (string) data_get($confirmation, 'customer.address', ''),
            'city' => data_get($confirmation, 'customer.city'),
            'town' => data_get($confirmation, 'customer.town'),
            'province' => data_get($confirmation, 'customer.province'),
            'postal_code' => data_get($confirmation, 'customer.postal_code'),
            'notes' => data_get($confirmation, 'customer.notes'),
            'shipping_method' => (string) data_get($confirmation, 'shipping_method', 'standard'),
            'payment_method' => (string) data_get($confirmation, 'payment_method', 'card'),
        ];

        $receiptImagePath = null;
        if (($validated['payment_method'] ?? 'card') === 'bank') {
            $request->validate([
                'receipt_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            ]);

            $receiptFile = $request->file('receipt_image');
            if ($receiptFile) {
                $receiptDirectory = public_path('images/Receipt');
                File::ensureDirectoryExists($receiptDirectory);

                $receiptFileName = 'receipt_' . now()->format('YmdHis') . '_' . uniqid() . '.' . $receiptFile->getClientOriginalExtension();
                $receiptFile->move($receiptDirectory, $receiptFileName);
                $receiptImagePath = 'images/Receipt/' . $receiptFileName;
            }
        }

        $cart = $this->loadCart();
        $itemsForOrder = collect($confirmation['items'])->values()->all();
        $stockError = $this->checkoutStockError($itemsForOrder);
        if ($stockError) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $stockError], 422);
            }

            return redirect()->route('checkout')->with('checkout_error', $stockError);
        }
        $subtotal = (float) ($confirmation['subtotal'] ?? 0);
        $shippingCost = (float) ($confirmation['shipping_cost'] ?? 0);
        $total = (float) ($confirmation['total'] ?? 0);
        $pickupOnly = (bool) ($confirmation['pickup_only'] ?? false);
        $depositAmount = (float) ($confirmation['deposit_amount'] ?? 0);
        $balanceDue = (float) ($confirmation['balance_due'] ?? 0);
        $quotationCheckout = $request->session()->get('custom_quotation_checkout');

        $order = DB::transaction(function () use ($validated, $receiptImagePath, $cart, $itemsForOrder, $subtotal, $shippingCost, $total, $pickupOnly, $depositAmount, $balanceDue, $quotationCheckout) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $this->makeOrderNumber(),
                'shipping_method' => $validated['shipping_method'],
                'payment_method' => $validated['payment_method'],
                'status' => 'Pending',
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'],
                'city' => $validated['city'] ?? null,
                'town' => $validated['town'] ?? null,
                'province' => $validated['province'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'receipt_image' => $receiptImagePath,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'pickup_only' => $pickupOnly,
                'deposit_amount' => $depositAmount,
                'balance_due' => $balanceDue,
                'total' => $total,
            ]);

            foreach ($itemsForOrder as $item) {
                $productId = (int) ($item['product_id'] ?? $item['id'] ?? 0);
                $product = $productId ? Product::query()->find($productId) : null;
                $quantity = max(1, (int) ($item['quantity'] ?? 1));
                if ($product && empty($quotationCheckout)) {
                    $currentStock = (int) ($product->stock ?? 0);
                    $product->stock = max(0, $currentStock - $quantity);
                    $product->save();
                }
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => (string) ($item['name'] ?? $product?->name ?? 'Product'),
                    'product_image' => $product?->image ?? $this->resolveImageName($item['image'] ?? null),
                    'quantity' => $quantity,
                    'unit_price' => (float) ($item['price'] ?? $product?->price ?? 0),
                    'line_total' => ((float) ($item['price'] ?? $product?->price ?? 0)) * $quantity,
                ]);
            }

            if (empty($quotationCheckout)) {
                $cart->items()->delete();
            }

            return $order->load('items');
        });

        if (is_array($quotationCheckout) && !empty($quotationCheckout['quotation_id'] ?? null)) {
            $quotation = CustomJewelleryQuotation::query()->with('request')->find((int) $quotationCheckout['quotation_id']);
            if ($quotation) {
                $quotation->update([
                    'status' => 'Paid',
                    'paid_at' => now(),
                    'responded_at' => $quotation->responded_at ?: now(),
                ]);

                $quotation->request?->update([
                    'status' => 'Paid',
                ]);

                SiteNotification::create([
                    'recipient_user_id' => Auth::id(),
                    'recipient_role' => 'customer',
                    'category' => 'Custom Jewellery',
                    'title' => 'Quotation ' . $quotation->quotation_number . ' Paid',
                    'message' => 'Your quotation payment has been received. The custom jewellery request is now marked as paid.',
                    'status' => 'Unread',
                    'published_at' => now(),
                ]);
            }
        }

        $request->session()->forget('checkout_confirmation');
        $request->session()->forget('custom_quotation_checkout');

        if (! $request->expectsJson()) {
            return redirect()->route('orders')->with('checkout_success', 'Your order has been placed successfully.');
        }

        return response()->json([
            'ok' => true,
            'order' => [
                'order_number' => $order->order_number,
                'total' => (float) $order->total,
                'deposit_amount' => (float) $order->deposit_amount,
                'balance_due' => (float) $order->balance_due,
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->assertCustomer();

        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,product_id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
            'size_value' => ['nullable', 'string', 'max:120'],
        ]);

        $product = Product::query()->findOrFail($validated['product_id']);
        $sizeOptions = $this->parseSizeOptions($product->size_options ?? null);
        $sizeValue = trim((string) ($validated['size_value'] ?? ''));
        if (!empty($sizeOptions)) {
            if ($sizeValue === '') {
                $sizeValue = $sizeOptions[0];
            } elseif (!in_array($sizeValue, $sizeOptions, true)) {
                return back()->with('cart_error', 'Please select a valid size for ' . $product->name . '.');
            }
        } else {
            $sizeValue = '';
        }
        $currentStock = $this->resolveProductStock($product);
        if ($currentStock <= 0) {
            return back()->with('cart_error', "{$product->name} is out of stock right now.");
        }

        $cart = $this->loadCart();
        $quantity = (int) ($validated['quantity'] ?? 1);
        if ($quantity > $currentStock) {
            return back()->with('cart_error', "Only {$currentStock} left for {$product->name}.");
        }

        $item = $cart->items()->firstOrNew(['product_id' => $product->product_id]);
        $item->quantity = ($item->exists ? (int) $item->quantity : 0) + $quantity;
        if ($item->quantity > $currentStock) {
            return back()->with('cart_error', "Only {$currentStock} left for {$product->name}.");
        }
        $item->price_at_add_time = $this->resolveProductPrice($product);
        $item->size_value = $sizeValue !== '' ? $sizeValue : null;
        $item->save();

        return back()->with('cart_success', "{$product->name} added to cart.");
    }

    public function update(Request $request, CartItem $item): RedirectResponse
    {
        $this->assertCustomer();
        $this->assertCartOwnership($item);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $item->update(['quantity' => $validated['quantity']]);

        return back();
    }

    public function destroy(CartItem $item): RedirectResponse
    {
        $this->assertCustomer();
        $this->assertCartOwnership($item);

        $item->delete();

        return back()->with('cart_success', 'Product removed from cart.');
    }

    public function clear(Request $request): JsonResponse
    {
        $this->assertCustomer();
        $cart = $this->loadCart();

        $validatedIds = $request->validate([
            'ids' => ['sometimes', 'array'],
            'ids.*' => ['integer'],
        ]);

        if (!empty($validatedIds['ids'])) {
            $cart->items()->whereIn('product_id', $validatedIds['ids'])->delete();
        } else {
            $cart->items()->delete();
        }

        return response()->json(['ok' => true]);
    }

    public function sync(Request $request): JsonResponse
    {
        $this->assertCustomer();

        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer', 'exists:products,product_id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
            'items.*.size_value' => ['nullable', 'string', 'max:120'],
        ]);

        $cart = $this->loadCart();
        $cart->items()->delete();

        foreach ($validated['items'] as $row) {
            $product = Product::query()->findOrFail($row['id']);
            $sizeOptions = $this->parseSizeOptions($product->size_options ?? null);
            $sizeValue = trim((string) ($row['size_value'] ?? ''));
            if (!empty($sizeOptions) && $sizeValue === '') {
                $sizeValue = $sizeOptions[0];
            }

            $cart->items()->create([
                'product_id' => $product->product_id,
                'quantity' => (int) $row['quantity'],
                'price_at_add_time' => $this->resolveProductPrice($product),
                'size_value' => $sizeValue !== '' ? $sizeValue : null,
            ]);
        }

        return response()->json([
            'ok' => true,
            'items' => $this->buildCartItems($cart->fresh(['items.product'])),
        ]);
    }

    private function assertCustomer(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'customer', 403);
    }

    private function loadCart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => Auth::id()]);
    }

    private function makeOrderNumber(): string
    {
        return 'PG-' . now()->format('YmdHis') . '-' . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function resolveImageName(?string $image): ?string
    {
        if (!$image) {
            return null;
        }

        return basename(parse_url($image, PHP_URL_PATH) ?? $image);
    }

    private function assertCartOwnership(CartItem $item): void
    {
        $cart = $this->loadCart();

        abort_unless((int) $item->cart_id === (int) $cart->id, 403);
    }

    private function cartViewData(Cart $cart): array
    {
        $cart->loadMissing(['items.product']);
        $items = $this->buildCartItems($cart);
        $subtotal = collect($items)->sum(fn ($item) => (float) $item['price'] * (int) $item['quantity']);
        $count = collect($items)->sum('quantity');

        return [
            'cartItems' => $items,
            'cartSubtotal' => $subtotal,
            'cartCount' => $count,
        ];
    }

    private function buildCartItems(Cart $cart): array
    {
        return $cart->items->map(function (CartItem $item) {
            $product = $item->product;

            return [
                'id' => (string) $item->product_id,
                'product_id' => $item->product_id,
                'name' => $product?->name ?? 'Product',
                'description' => $product?->description,
                'size_value' => $item->size_value ?: '',
                'size_label' => $product?->size_label ?: '',
                'image' => $product?->image
                    ? asset('images/Product/'.$product->image)
                    : asset('images/placeholders/notavailable.png'),
                'price' => number_format((float) ($product ? $this->resolveProductPrice($product) : ($item->price_at_add_time ?? 0)), 2, '.', ''),
                'quantity' => (int) $item->quantity,
                'stock' => $this->resolveProductStock($product),
                'stock_label' => $this->productStockLabel($product),
                'stock_status' => $this->productStockStatus($product),
                'can_purchase' => $this->resolveProductStock($product) > 0,
                'targetUrl' => $product ? route('products.show', $product) : '#',
            ];
        })->values()->all();
    }

    private function normalizeCheckoutItems(array $items): array
    {
        return collect($items)->map(function (array $item) {
            $productId = (int) ($item['product_id'] ?? $item['id'] ?? 0);
            $product = $productId ? Product::query()->with(['jewellery'])->find($productId) : null;
            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            $resolvedPrice = $product ? $this->resolveProductPrice($product) : (float) ($item['price'] ?? 0);

            return [
                'id' => (string) ($product?->product_id ?? ($item['id'] ?? $productId)),
                'product_id' => $product?->product_id ?? $productId,
                'name' => (string) ($product?->name ?? $item['name'] ?? 'Product'),
                'description' => $product?->description ?? ($item['description'] ?? null),
                'size_value' => (string) ($item['size_value'] ?? ''),
                'size_label' => (string) ($product?->size_label ?? $item['size_label'] ?? ''),
                'image' => $product?->image
                    ? asset('images/Product/'.$product->image)
                    : ($item['image'] ?? asset('images/placeholders/notavailable.png')),
                'price' => number_format($resolvedPrice, 2, '.', ''),
                'quantity' => $quantity,
                'stock' => $this->resolveProductStock($product),
                'stock_label' => $this->productStockLabel($product),
                'stock_status' => $this->productStockStatus($product),
                'can_purchase' => $product ? $this->resolveProductStock($product) > 0 : true,
                'targetUrl' => $product ? route('products.show', $product) : ($item['targetUrl'] ?? '#'),
            ];
        })->values()->all();
    }

    private function checkoutStockError(array $items): ?string
    {
        foreach ($items as $item) {
            $productId = (int) ($item['product_id'] ?? $item['id'] ?? 0);
            if ($productId <= 0) {
                continue;
            }

            $product = Product::query()->find($productId);
            if (! $product) {
                continue;
            }

            $availableStock = $this->resolveProductStock($product);
            $quantity = max(1, (int) ($item['quantity'] ?? 1));

            if ($availableStock <= 0) {
                return "{$product->name} is out of stock right now.";
            }

            if ($quantity > $availableStock) {
                return "Only {$availableStock} left for {$product->name}.";
            }
        }

        return null;
    }

    private function resolveProductStock(?Product $product): int
    {
        return max(0, (int) ($product?->stock ?? 0));
    }

    private function productStockStatus(?Product $product): string
    {
        $stock = $this->resolveProductStock($product);

        if ($stock <= 0) {
            return 'Out of Stock';
        }

        if ($stock <= 5) {
            return 'Critical';
        }

        return 'In Stock';
    }

    private function productStockLabel(?Product $product): string
    {
        $stock = $this->resolveProductStock($product);

        if ($stock <= 0) {
            return 'Out of Stock';
        }

        if ($stock <= 5) {
            return 'Only ' . $stock . ' left';
        }

        return 'In Stock';
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

    private function resolveProductPrice(Product $product): float
    {
        return $this->pricingService->priceForProduct($product, (float) $product->getRawOriginal('price'));
    }
}
