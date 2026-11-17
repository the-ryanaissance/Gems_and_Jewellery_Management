<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Piyumatha Gems & Jewellery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Manrope', sans-serif; color: #261d16; background: radial-gradient(circle at top left, rgba(212, 177, 113, 0.22), transparent 28%), radial-gradient(circle at top right, rgba(47, 111, 101, 0.12), transparent 22%), linear-gradient(180deg, #fffdf8 0%, #f9f3ea 52%, #fffaf5 100%); min-height: 100vh; }
        .checkout-shell { width: min(1180px, calc(100% - 28px)); margin: 26px auto 56px; display: grid; gap: 20px; }
        .checkout-hero { display: flex; justify-content: space-between; align-items: flex-end; gap: 18px; padding: 28px 30px; border-radius: 28px; background: linear-gradient(135deg, rgba(255, 249, 240, 0.98), rgba(247, 238, 223, 0.96)); border: 1px solid rgba(214, 187, 145, 0.55); box-shadow: 0 20px 50px rgba(71, 50, 28, 0.08); }
        .eyebrow { display: inline-flex; align-items: center; gap: 8px; padding: 7px 12px; border-radius: 999px; background: rgba(47, 111, 101, 0.1); color: #2f6f65; font-size: .82rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
        .checkout-hero h1 { margin-top: 14px; font-family: 'Cormorant Garamond', serif; font-size: clamp(2.4rem, 5vw, 4rem); line-height: .95; color: #2b2118; }
        .checkout-hero p { margin-top: 12px; max-width: 680px; color: #715d49; line-height: 1.7; font-size: 1rem; }
        .checkout-badges { display: flex; flex-wrap: wrap; gap: 10px; justify-content: flex-end; }
        .checkout-badge { min-width: 140px; padding: 14px 16px; border-radius: 20px; background: #fff; border: 1px solid rgba(220, 199, 168, 0.8); }
        .checkout-badge span { display: block; color: #8a6f50; font-size: .78rem; text-transform: uppercase; letter-spacing: .08em; }
        .checkout-badge strong { display: block; margin-top: 8px; font-size: 1.15rem; color: #214841; }
        .checkout-layout { display: grid; grid-template-columns: minmax(0, 1.6fr) minmax(320px, .9fr); gap: 22px; align-items: start; }
        .checkout-card { background: rgba(255, 255, 255, 0.96); border: 1px solid rgba(225, 206, 178, 0.9); border-radius: 28px; box-shadow: 0 18px 44px rgba(71, 50, 28, 0.08); }
        .checkout-main { padding: 28px; display: grid; gap: 22px; }
        .section-box { padding: 22px; border-radius: 24px; background: linear-gradient(180deg, #fffdf9 0%, #fff8ee 100%); border: 1px solid #efdec7; }
        .checkout-summary-box { padding: 18px; }
        .section-box h2 { font-size: 1.18rem; color: #2d221a; margin-bottom: 8px; }
        .section-box p { color: #816b54; line-height: 1.65; font-size: .95rem; }
        .section-head-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 16px; }
        .mini-chip { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 999px; background: #f7efe2; color: #8a6f50; font-size: .82rem; font-weight: 700; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .field { display: grid; gap: 8px; }
        .field.full { grid-column: 1 / -1; }
        .field label { font-size: .92rem; font-weight: 700; color: #4c3b2a; }
        .field input, .field textarea, .field select { width: 100%; border: 1px solid #e6cfaa; border-radius: 16px; background: #fff; color: #2d241c; padding: 14px 16px; font: inherit; outline: none; transition: border-color .2s ease, box-shadow .2s ease; }
        .field textarea { min-height: 110px; resize: vertical; }
        .field input:focus, .field textarea:focus, .field select:focus { border-color: #b89250; box-shadow: 0 0 0 4px rgba(184, 146, 80, 0.12); }
        .field-error { color: #b33838; font-size: .82rem; min-height: 18px; }
        .shipping-grid, .payment-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .select-tile { position: relative; border: 1px solid #ead8bf; border-radius: 20px; background: #fff; padding: 18px; cursor: pointer; display: grid; gap: 10px; transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease; }
        .select-tile:hover { transform: translateY(-2px); border-color: #cda568; box-shadow: 0 14px 28px rgba(184, 146, 80, 0.12); }
        .select-tile input { position: absolute; opacity: 0; pointer-events: none; }
        .select-tile.active { border-color: #b89250; box-shadow: 0 16px 32px rgba(184, 146, 80, 0.15); background: linear-gradient(180deg, #fffdf8 0%, #f9f1e2 100%); }
        .select-tile strong { font-size: 1rem; color: #2d241c; }
        .select-tile span { color: #7d664e; line-height: 1.55; font-size: .9rem; }
        .select-tile .price-tag { color: #214841; font-weight: 800; font-size: .96rem; }
        .checkout-side { padding: 24px; display: grid; gap: 18px; position: sticky; top: 96px; }
        .order-items { display: grid; gap: 14px; }
        .order-item { display: grid; grid-template-columns: 72px minmax(0, 1fr) auto; gap: 12px; align-items: start; padding: 14px; border-radius: 22px; background: #fffaf2; border: 1px solid #efdfca; }
        .order-item img { width: 72px; height: 72px; object-fit: cover; border-radius: 18px; }
        .order-item-body { min-width: 0; }
        .order-item strong { display: block; color: #2c2118; line-height: 1.35; }
        .order-item span { display: block; margin-top: 4px; color: #846d57; font-size: .9rem; line-height: 1.5; word-break: break-word; }
        .order-item em { font-style: normal; color: #214841; font-weight: 800; white-space: nowrap; padding-top: 2px; }
        .stock-pill{display:inline-flex;align-items:center;padding:5px 10px;border-radius:999px;font-size:.74rem;font-weight:800;letter-spacing:.25px;text-transform:uppercase;border:1px solid transparent;width:max-content}
        .stock-pill.in-stock{background:#edf7ee;color:#245f30;border-color:#c9e8ce}
        .stock-pill.critical{background:#fff0e7;color:#b55a2d;border-color:#f1ccb5}
        .stock-pill.out-of-stock{background:#f5e6e6;color:#a33;border-color:#edc8c8}
        .quotation-banner {
            margin-top: 10px;
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(135deg, #fff7e7, #fff1d7);
            border: 1px solid #e7c98f;
            color: #7c5b22;
            font-weight: 700;
            line-height: 1.65;
        }
        .summary-list { display: grid; gap: 12px; }
        .summary-row { display: flex; justify-content: space-between; gap: 12px; color: #6f5b47; font-size: .95rem; }
        .summary-row strong { color: #2b2118; }
        .summary-total { padding-top: 14px; border-top: 1px dashed #e2ccb0; font-size: 1.08rem; }
        .checkout-submit { width: 100%; height: 54px; border: none; border-radius: 18px; background: linear-gradient(135deg, #22201d, #000); color: #fff; font-weight: 800; font-size: 1rem; cursor: pointer; }
        .helper-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; color: #7d664e; font-size: .9rem; }
        .helper-row a { color: #2f6f65; text-decoration: none; font-weight: 700; }
        .empty-state, .success-state { display: none; padding: 28px; text-align: center; gap: 14px; }
        .empty-state.show, .success-state.show { display: grid; }
        .empty-icon, .success-icon { width: 72px; height: 72px; margin: 0 auto; border-radius: 24px; display: grid; place-items: center; font-size: 1.5rem; color: #fff; }
        .empty-icon { background: linear-gradient(135deg, #b89250, #8f6d3a); }
        .success-icon { background: linear-gradient(135deg, #2f6f65, #214841); }
        .empty-state h2, .success-state h2 { font-family: 'Cormorant Garamond', serif; font-size: 2.2rem; color: #2c2118; }
        .empty-state p, .success-state p { color: #7c6650; line-height: 1.7; max-width: 620px; margin: 0 auto; }
        .empty-actions, .success-actions { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin-top: 8px; }
        .soft-btn, .dark-btn { display: inline-flex; justify-content: center; align-items: center; min-width: 170px; height: 50px; border-radius: 16px; font-weight: 800; text-decoration: none; cursor: pointer; }
        .soft-btn { border: 1px solid #e6cfaa; background: #fff; color: #755a3c; }
        .dark-btn { border: none; background: linear-gradient(135deg, #2f6f65, #214841); color: #fff; }
        .checkout-page-content.is-success .checkout-hero, .checkout-page-content.is-success .checkout-layout { display: none; }
        @media (max-width: 960px) { .checkout-layout { grid-template-columns: 1fr; } .checkout-side { position: static; } .checkout-hero { display: grid; } .checkout-badges { justify-content: flex-start; } }
        @media (max-width: 720px) { .checkout-shell { width: min(100% - 18px, 100%); margin-top: 16px; } .checkout-hero, .checkout-main, .checkout-side { padding: 20px; } .field-grid, .shipping-grid, .payment-grid { grid-template-columns: 1fr; } .order-item { grid-template-columns: 64px 1fr; } .order-item em { grid-column: 2; } }
    </style>
</head>
<body>
    <x-navbar />

    <main class="checkout-shell checkout-page-content" id="checkoutPageContent">
        <section class="checkout-hero">
            <div>
                <span class="eyebrow"><i class="fas fa-lock"></i> Secure Checkout</span>
                <h1>Complete Your Order</h1>
                <p>Review your selected gem and jewellery pieces, add delivery details, and continue with a polished checkout flow designed for customer orders.</p>
                @if (!empty($quotationCheckout))
                    <div class="quotation-banner">This custom quotation has been loaded into the normal checkout flow. If the total is above Rs 40,000, pickup only will apply automatically.</div>
                @endif
            </div>

        </section>

        <section class="checkout-layout">
            <section class="checkout-card checkout-main">
                <div class="section-box">
                    <div class="section-head-row">
                        <div>
                            <h2>Shipping Address</h2>
                            <p>Fill in your delivery details carefully so the admin team can prepare the right order handoff.</p>
                        </div>
                    </div>
                    <form id="checkoutForm" novalidate>
                        <div class="field-grid">
                            <div class="field">
                                <label for="checkoutFirstName">First Name</label>
                                <input id="checkoutFirstName" name="first_name" type="text" value="{{ auth()->user()->first_name }}" placeholder="First name">
                                <div class="field-error" data-error-for="first_name"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutLastName">Last Name</label>
                                <input id="checkoutLastName" name="last_name" type="text" value="{{ auth()->user()->last_name }}" placeholder="Last name">
                                <div class="field-error" data-error-for="last_name"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutEmail">Email</label>
                                <input id="checkoutEmail" name="email" type="email" value="{{ auth()->user()->email }}" placeholder="Email address">
                                <div class="field-error" data-error-for="email"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutPhone">Phone Number</label>
                                <input id="checkoutPhone" name="phone" type="text" value="{{ auth()->user()->phone_number }}" placeholder="07XXXXXXXX">
                                <div class="field-error" data-error-for="phone"></div>
                            </div>
                            <div class="field full">
                                <label for="checkoutAddress">Address</label>
                                <textarea id="checkoutAddress" name="address" placeholder="Street address, apartment, landmark">{{ auth()->user()->address }}</textarea>
                                <div class="field-error" data-error-for="address"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutCity">City</label>
                                <select id="checkoutCity" name="city" disabled>
                                    <option value="" selected>Select city</option>
                                </select>
                                <div class="field-error" data-error-for="city"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutProvince">Province</label>
                                <select id="checkoutProvince" name="province">
                                    <option value="" disabled {{ old('province') ? '' : 'selected' }}>Select province</option>
                                    @foreach (['Western Province', 'Central Province', 'Southern Province', 'Northern Province', 'Eastern Province', 'North Western Province', 'North Central Province', 'Uva Province', 'Sabaragamuwa Province'] as $provinceOption)
                                        <option value="{{ $provinceOption }}" {{ old('province') === $provinceOption ? 'selected' : '' }}>
                                            {{ $provinceOption }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="field-error" data-error-for="province"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutTown">Town</label>
                                <input id="checkoutTown" name="town" type="text" placeholder="Ratnapura">
                                <div class="field-error" data-error-for="town"></div>
                            </div>
                            <div class="field">
                                <label for="checkoutPostal">Postal Code</label>
                                <input id="checkoutPostal" name="postal_code" type="text" placeholder="10100">
                                <div class="field-error" data-error-for="postal_code"></div>
                            </div>
                            <div class="field full">
                                <label for="checkoutNotes">Delivery Notes</label>
                                <textarea id="checkoutNotes" name="notes" placeholder="Special delivery note, gate instructions, or preferred contact message."></textarea>
                                <div class="field-error" data-error-for="notes"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="section-box">
                    <div class="section-head-row">
                        <div>
                            <h2>Shipping Method</h2>
                            <p>Choose the delivery pace that best matches your order timeline.</p>
                        </div>
                    </div>
                    <p id="pickupOnlyNotice" style="display:none;margin:-4px 0 14px;color:#8c6429;font-weight:700;line-height:1.6;">Orders above Rs 40,000 are available for pickup only. Delivery options will be locked, 20% will be charged now, and the balance will be paid at pickup. Smaller orders can still choose store pickup with Rs 0 delivery fee.</p>
                    <div class="shipping-grid" id="shippingOptions">
                        <label class="select-tile active">
                            <input type="radio" name="shipping_method" value="standard" checked data-price="200">
                            <strong>Standard Shipping</strong>
                            <span>Within 7 to 10 business days for standard islandwide delivery.</span>
                            <span class="price-tag">Rs 200</span>
                        </label>
                        <label class="select-tile">
                            <input type="radio" name="shipping_method" value="express" data-price="350">
                            <strong>Express Delivery</strong>
                            <span>Priority dispatch for urgent gemstone and jewellery orders.</span>
                            <span class="price-tag">Rs 350</span>
                        </label>
                        <label class="select-tile" id="pickupOnlyTile">
                            <input type="radio" name="shipping_method" value="pickup" data-price="0">
                            <strong>Store Pickup</strong>
                            <span>Collect your order from the Ratnapura showroom with no delivery fee.</span>
                            <span class="price-tag">Rs 0</span>
                        </label>
                    </div>
                </div>

                <div class="section-box">
                    <div class="section-head-row">
                        <div>
                            <h2>Payment Method</h2>
                           
                        </div>
                    </div>
                    <div class="payment-grid" id="paymentOptions">
                        <label class="select-tile active">
                            <input type="radio" name="payment_method" value="card" checked>
                            <strong>Card Payment</strong>
                            <span>Continue with secure payment confirmation after order review.</span>
                            <span class="price-tag">Visa / Master / Amex</span>
                        </label>
                        <label class="select-tile">
                            <input type="radio" name="payment_method" value="bank">
                            <strong>Bank Transfer</strong>
                            <span>Receive account details and confirmation instructions from the team.</span>
                            <span class="price-tag">Manual Confirmation</span>
                        </label>
                        <label class="select-tile">
                            <input type="radio" name="payment_method" value="cod">
                            <strong>Cash on Delivery</strong>
                            <span>Pay the full amount when the order is delivered to your address.</span>
                            <span class="price-tag">Delivery Handoff</span>
                        </label>
                    </div>
                </div>
            </section>

            <aside class="checkout-card checkout-side">
                <div>
                    <div class="section-head-row">
                        <div>
                            <h2>Your Cart</h2>
                            <p id="checkoutSummaryNote">Selected products prepared for checkout.</p>
                        </div>
                        <span class="mini-chip" id="checkoutItemCount">0 Items</span>
                    </div>
                    <div class="order-items" id="checkoutItems"></div>
                </div>

                <div class="section-box checkout-summary-box">
                    <div class="summary-list">
                        <div class="summary-row"><span>Subtotal</span><strong id="summarySubtotal">Rs 0</strong></div>
                        <div class="summary-row"><span>Shipping</span><strong id="summaryShipping">Rs 0</strong></div>
                        <div class="summary-row" id="summaryDepositRow" style="display:none;"><span>Deposit Now</span><strong id="summaryDeposit">Rs 0</strong></div>
                        <div class="summary-row" id="summaryBalanceRow" style="display:none;"><span>Balance at Pickup</span><strong id="summaryBalance">Rs 0</strong></div>
                        <div class="summary-row"><span>Service Support</span><strong>Included</strong></div>
                        <div class="summary-row summary-total"><span>Total</span><strong id="summaryTotal">Rs 0</strong></div>
                    </div>
                </div>

                <button class="checkout-submit" id="checkoutSubmitBtn" type="button">Continue To Payment</button>
                <div class="field-error" id="checkoutStatusMessage" style="min-height: 22px; margin-top: 10px; text-align: center;"></div>
                <div class="helper-row">
                    <span><i class="fas fa-lock"></i> Secure customer checkout flow</span>
                    <a href="{{ route('cart') }}">Back to cart</a>
                </div>
            </aside>
        </section>

        <section class="checkout-card empty-state" id="checkoutEmptyState">
            <div class="empty-icon"><i class="fas fa-bag-shopping"></i></div>
            <h2>No Checkout Items Yet</h2>
            <p>Select products from your shopping cart or use the product detail page Buy It Now action, then come back here to finish the order.</p>
            <div class="empty-actions">
                <a href="{{ route('cart') }}" class="soft-btn">Go To Cart</a>
                <a href="{{ route('jewellery') }}" class="dark-btn">Browse Products</a>
            </div>
        </section>

        <section class="checkout-card success-state" id="checkoutSuccessState">
            <div class="success-icon"><i class="fas fa-circle-check"></i></div>
            <h2>Order Checkout Created</h2>
            <p id="checkoutSuccessText">Your order has been prepared successfully. The admin team can now continue with delivery and payment coordination using the details you submitted.</p>
            <div class="success-actions">
                <a href="{{ route('orders') }}" class="dark-btn">View Orders</a>
                <a href="{{ route('jewellery') }}" class="soft-btn">Continue Shopping</a>
            </div>
        </section>
    </main>

    <x-footer />
    <script>
        (() => {
            const checkoutStorageKey = 'pg_checkout_session';
            const cartStorageKey = 'pg_cart';
            const cartSelectedStorageKey = 'pg_cart_selected';
            const placedOrdersStorageKey = 'pg_checkout_orders';
            const csrfToken = @json(csrf_token());
            const initialCartItems = @json($cartItems ?? []);
            const checkoutStoreRoute = @json(route('checkout.store'));
            const quotationCheckout = @json((bool) ($quotationCheckout ?? false));
            const checkoutPageContent = document.getElementById('checkoutPageContent');
            const checkoutForm = document.getElementById('checkoutForm');
            const checkoutItems = document.getElementById('checkoutItems');
            const checkoutItemCount = document.getElementById('checkoutItemCount');
            const checkoutSummaryNote = document.getElementById('checkoutSummaryNote');
            const summarySubtotal = document.getElementById('summarySubtotal');
            const summaryShipping = document.getElementById('summaryShipping');
            const summaryDepositRow = document.getElementById('summaryDepositRow');
            const summaryDeposit = document.getElementById('summaryDeposit');
            const summaryBalanceRow = document.getElementById('summaryBalanceRow');
            const summaryBalance = document.getElementById('summaryBalance');
            const summaryTotal = document.getElementById('summaryTotal');
            const checkoutSubmitBtn = document.getElementById('checkoutSubmitBtn');
            const checkoutEmptyState = document.getElementById('checkoutEmptyState');
            const checkoutSuccessState = document.getElementById('checkoutSuccessState');
            const checkoutSuccessText = document.getElementById('checkoutSuccessText');
            const checkoutStatusMessage = document.getElementById('checkoutStatusMessage');
            const shippingOptions = document.getElementById('shippingOptions');
            const paymentOptions = document.getElementById('paymentOptions');
            const pickupOnlyNotice = document.getElementById('pickupOnlyNotice');
            const pickupOnlyTile = document.getElementById('pickupOnlyTile');
            const checkoutCity = document.getElementById('checkoutCity');
            const checkoutProvince = document.getElementById('checkoutProvince');
            const codInput = paymentOptions?.querySelector('input[value="cod"]');
            window.__cartItems = Array.isArray(initialCartItems) ? initialCartItems : [];

            const parsePrice = (value) => {
                const numeric = Number(String(value || '').replace(/[^0-9.]/g, ''));
                return Number.isFinite(numeric) ? numeric : 0;
            };
            const formatLkr = (value) => `Rs ${Number(value || 0).toLocaleString('en-LK', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
            const provinceCities = {
                'Western Province': ['Colombo', 'Gampaha', 'Kalutara'],
                'Central Province': ['Kandy', 'Matale', 'Nuwara Eliya'],
                'Southern Province': ['Galle', 'Matara', 'Hambantota'],
                'Northern Province': ['Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya'],
                'Eastern Province': ['Batticaloa', 'Ampara', 'Trincomalee'],
                'North Western Province': ['Kurunegala', 'Puttalam'],
                'North Central Province': ['Anuradhapura', 'Polonnaruwa'],
                'Uva Province': ['Badulla', 'Monaragala'],
                'Sabaragamuwa Province': ['Ratnapura', 'Kegalle'],
            };
            const quotationImages = {
                ring: @json(asset('images/main_website/web_ji1.png')),
                necklace: @json(asset('images/main_website/web_ji5.png')),
                chain: @json(asset('images/main_website/web_ji9.png')),
                bracelet: @json(asset('images/main_website/web_ji2.png')),
                bangle: @json(asset('images/main_website/web_ji6.png')),
                earring: @json(asset('images/main_website/web_ji3.png')),
                pendant: @json(asset('images/main_website/web_ji10.png')),
                other: @json(asset('images/main_website/web_ji11.png')),
            };
            const resolveQuotationType = (item) => {
                const raw = String(
                    item?.quotation_type
                    || item?.jewellery_type
                    || item?.type
                    || item?.description?.split('·')[0]
                    || item?.description?.split('|')[0]
                    || item?.name
                    || ''
                ).toLowerCase();

                if (raw.includes('ring')) return 'ring';
                if (raw.includes('necklace')) return 'necklace';
                if (raw.includes('chain')) return 'chain';
                if (raw.includes('bracelet')) return 'bracelet';
                if (raw.includes('bangle')) return 'bangle';
                if (raw.includes('earring')) return 'earring';
                if (raw.includes('pendant')) return 'pendant';
                return 'other';
            };
            const getCartItems = () => {
                return Array.isArray(window.__cartItems) ? window.__cartItems : [];
            };
            const saveCartItems = (items) => {
                window.__cartItems = Array.isArray(items) ? items : [];
                localStorage.setItem(cartStorageKey, JSON.stringify(window.__cartItems));
                fetch(@json(route('cart.sync')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        items: window.__cartItems.map((item) => ({
                            id: item.product_id || item.id,
                            quantity: Number(item.quantity) || 1,
                        })),
                    }),
                }).catch(() => {});
            };
            const getSelectedCartIds = () => {
                try {
                    return JSON.parse(localStorage.getItem(cartSelectedStorageKey) || '[]');
                } catch (error) {
                    return [];
                }
            };
            const saveSelectedCartIds = (ids) => {
                localStorage.setItem(cartSelectedStorageKey, JSON.stringify(ids));
            };
            const getCheckoutSession = () => {
                try {
                    return JSON.parse(localStorage.getItem(checkoutStorageKey) || 'null');
                } catch (error) {
                    return null;
                }
            };
            const saveCheckoutSession = (payload) => {
                localStorage.setItem(checkoutStorageKey, JSON.stringify(payload));
            };
            const clearCheckoutSession = () => {
                localStorage.removeItem(checkoutStorageKey);
            };
            const currentCartItemMap = new Map((Array.isArray(initialCartItems) ? initialCartItems : []).map((item) => [String(item.id || item.product_id || ''), item]));
            const hydrateCheckoutItem = (item) => {
                const key = String(item?.id || item?.product_id || '');
                const currentItem = currentCartItemMap.get(key);
                const quotationType = resolveQuotationType(item);
                if (!currentItem) {
                    return quotationCheckout && quotationType && quotationImages[quotationType]
                        ? { ...item, image: quotationImages[quotationType] }
                        : item;
                }
                return {
                    ...item,
                    ...currentItem,
                    quantity: Number(item.quantity ?? currentItem.quantity ?? 1) || 1,
                    price: currentItem.price ?? item.price,
                    image: quotationCheckout && quotationType && quotationImages[quotationType]
                        ? quotationImages[quotationType]
                        : (currentItem.image ?? item.image),
                };
            };
            const getPlacedOrders = () => {
                try {
                    return JSON.parse(localStorage.getItem(placedOrdersStorageKey) || '[]');
                } catch (error) {
                    return [];
                }
            };
            const savePlacedOrders = (items) => {
                localStorage.setItem(placedOrdersStorageKey, JSON.stringify(items));
            };
            const getActiveShippingPrice = () => {
                const selected = shippingOptions?.querySelector('input[name="shipping_method"]:checked');
                return Number(selected?.dataset.price || 0);
            };
            const getItemsSubtotal = () => activeItems.reduce((sum, item) => sum + (parsePrice(item.price) * (Number(item.quantity) || 1)), 0);
            const syncShippingMode = () => {
                const subtotal = getItemsSubtotal();
                const pickupOnly = subtotal > 40000;
                const standardInput = shippingOptions?.querySelector('input[value="standard"]');
                const expressInput = shippingOptions?.querySelector('input[value="express"]');
                const pickupInput = shippingOptions?.querySelector('input[value="pickup"]');

                if (pickupOnlyNotice) pickupOnlyNotice.style.display = pickupOnly ? 'block' : 'none';
                if (pickupOnlyTile) pickupOnlyTile.style.display = 'grid';

                if (standardInput) standardInput.disabled = pickupOnly;
                if (expressInput) expressInput.disabled = pickupOnly;
                if (codInput) codInput.disabled = pickupOnly;

                if (pickupOnly) {
                    if (pickupInput) pickupInput.checked = true;
                    if (codInput?.checked) {
                        const cardInput = paymentOptions?.querySelector('input[value="card"]');
                        if (cardInput) cardInput.checked = true;
                    }
                } else {
                    const anyShippingSelected = !!shippingOptions?.querySelector('input[name="shipping_method"]:checked');
                    if (!anyShippingSelected && standardInput) {
                        standardInput.checked = true;
                    }
                }

                renderSelectTiles(shippingOptions);
            };
            const getCheckoutItems = () => {
                if (quotationCheckout && Array.isArray(initialCartItems) && initialCartItems.length) {
                    return initialCartItems.map(hydrateCheckoutItem);
                }

                const session = getCheckoutSession();
                if (session?.items?.length) {
                    const refreshedItems = session.items.map(hydrateCheckoutItem);
                    saveCheckoutSession({
                        ...session,
                        items: refreshedItems,
                    });
                    return refreshedItems;
                }

                const cartItems = getCartItems();
                const selectedIds = getSelectedCartIds();
                const fallbackItems = selectedIds.length
                    ? cartItems.filter((item) => selectedIds.includes(item.id))
                    : cartItems;

                if (fallbackItems.length) {
                    const refreshedItems = fallbackItems.map(hydrateCheckoutItem);
                    saveCheckoutSession({
                        source: selectedIds.length ? 'cart' : 'cart-fallback',
                        createdAt: new Date().toISOString(),
                        items: refreshedItems
                    });
                    return refreshedItems;
                }
                return [];
            };

            if (quotationCheckout && Array.isArray(window.__cartItems) && window.__cartItems[0]) {
                const quotationType = resolveQuotationType(window.__cartItems[0]);
                if (quotationType && quotationImages[quotationType]) {
                    window.__cartItems = window.__cartItems.map((item) => ({
                        ...item,
                        image: quotationImages[quotationType],
                    }));
                }
            }

            let activeItems = getCheckoutItems();

            const renderSelectTiles = (wrap) => {
                wrap?.querySelectorAll('.select-tile').forEach((tile) => {
                    const input = tile.querySelector('input');
                    tile.classList.toggle('active', !!input?.checked);
                });
            };

            const renderCityOptions = (provinceValue, selectedCity = '') => {
                if (!checkoutCity) return;

                const cities = provinceCities[provinceValue] || [];
                checkoutCity.innerHTML = '';

                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = provinceValue ? 'Select city' : 'Select province first';
                placeholder.disabled = true;
                placeholder.selected = !selectedCity;
                checkoutCity.appendChild(placeholder);

                cities.forEach((city) => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    if (selectedCity && selectedCity === city) {
                        option.selected = true;
                        placeholder.selected = false;
                    }
                    checkoutCity.appendChild(option);
                });

                checkoutCity.disabled = !provinceValue || cities.length === 0;
                if (!provinceValue || cities.length === 0) {
                    checkoutCity.value = '';
                } else if (!selectedCity || !cities.includes(selectedCity)) {
                    checkoutCity.value = cities[0];
                } else {
                    checkoutCity.value = selectedCity;
                }
            };

            renderCityOptions(checkoutProvince?.value || '', checkoutCity?.value || '');
            checkoutProvince?.addEventListener('change', () => {
                renderCityOptions(checkoutProvince.value, '');
            });

            const renderCheckoutSummary = () => {
                if (!activeItems.length) {
                    document.querySelector('.checkout-hero')?.style.setProperty('display', 'none');
                    document.querySelector('.checkout-layout')?.style.setProperty('display', 'none');
                    checkoutEmptyState?.classList.add('show');
                    return;
                }

                checkoutEmptyState?.classList.remove('show');
                syncShippingMode();
                const subtotal = getItemsSubtotal();
                const shipping = getActiveShippingPrice();
                const pickupOnly = subtotal > 40000;
                const deposit = pickupOnly ? Math.round(subtotal * 0.2) : subtotal + shipping;
                const balance = pickupOnly ? Math.max(subtotal - deposit, 0) : 0;
                const total = subtotal + shipping;
                const hasBlockedStock = activeItems.some((item) => Number(item.stock || 0) <= 0);

                if (checkoutItemCount) checkoutItemCount.textContent = `${activeItems.length} ${activeItems.length === 1 ? 'Item' : 'Items'}`;
                if (checkoutSummaryNote) {
                    checkoutSummaryNote.textContent = hasBlockedStock
                        ? 'One or more items are out of stock. Please remove them before continuing.'
                        : (pickupOnly
                        ? 'This order is pickup only. You will pay 20% now and the balance at pickup.'
                        : (activeItems.length > 1
                            ? 'Your selected items are lined up for one smooth checkout.'
                            : 'Your selected product is ready for checkout.'));
                }
                if (checkoutItems) {
                    checkoutItems.innerHTML = activeItems.map((item) => `
                        <article class="order-item">
                            <img src="${item.image}" alt="${item.name}">
                            <div class="order-item-body">
                                <strong>${item.name}</strong>
                                <span>${item.description || 'Prepared from your product selection.'}</span>
                                ${item.size_value ? `<span>${item.size_label || 'Size'}: ${item.size_value}</span>` : ''}
                                <span>Qty: ${Number(item.quantity) || 1}</span>
                                <span class="stock-pill ${String(item.stock_status || '').replace(/_/g, '-')}" style="margin-top:6px;">${item.stock_label || 'In Stock'}</span>
                            </div>
                            <em>${formatLkr(parsePrice(item.price) * (Number(item.quantity) || 1))}</em>
                        </article>
                    `).join('');
                }

                if (summarySubtotal) summarySubtotal.textContent = formatLkr(subtotal);
                if (summaryShipping) summaryShipping.textContent = formatLkr(shipping);
                if (summaryDepositRow) summaryDepositRow.style.display = pickupOnly ? 'flex' : 'none';
                if (summaryBalanceRow) summaryBalanceRow.style.display = pickupOnly ? 'flex' : 'none';
                if (summaryDeposit) summaryDeposit.textContent = formatLkr(pickupOnly ? deposit : total);
                if (summaryBalance) summaryBalance.textContent = formatLkr(balance);
                if (summaryTotal) summaryTotal.textContent = formatLkr(total);
                if (checkoutSubmitBtn) {
                    checkoutSubmitBtn.textContent = pickupOnly ? 'Continue To Deposit Payment' : 'Continue To Payment';
                    checkoutSubmitBtn.disabled = hasBlockedStock;
                    if (hasBlockedStock) {
                        checkoutSubmitBtn.textContent = 'Remove Out of Stock Items';
                    }
                }
            };

            const setFieldError = (name, message) => {
                const errorEl = document.querySelector(`[data-error-for="${name}"]`);
                if (errorEl) errorEl.textContent = message || '';
            };

            const setStatusMessage = (message = '', isError = false) => {
                if (!checkoutStatusMessage) return;
                checkoutStatusMessage.textContent = message;
                checkoutStatusMessage.style.color = isError ? '#b33838' : '#2f6f65';
            };

            const validateForm = () => {
                if (!checkoutForm) return false;
                const formData = new FormData(checkoutForm);
                let isValid = true;
                const values = {
                    first_name: String(formData.get('first_name') || '').trim(),
                    last_name: String(formData.get('last_name') || '').trim(),
                    email: String(formData.get('email') || '').trim(),
                    phone: String(formData.get('phone') || '').trim(),
                    address: String(formData.get('address') || '').trim(),
                    city: String(formData.get('city') || '').trim(),
                    province: String(formData.get('province') || '').trim(),
                    town: String(formData.get('town') || '').trim(),
                    postal_code: String(formData.get('postal_code') || '').trim()
                };

                Object.keys(values).forEach((key) => setFieldError(key, ''));

                if (!values.first_name || values.first_name.length < 2) { setFieldError('first_name', 'Enter a valid first name.'); isValid = false; }
                if (!values.last_name || values.last_name.length < 2) { setFieldError('last_name', 'Enter a valid last name.'); isValid = false; }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email)) { setFieldError('email', 'Enter a valid email address.'); isValid = false; }
                if (values.phone && !/^(\+94|0)\d{9}$/.test(values.phone.replace(/\s+/g, ''))) { setFieldError('phone', 'Enter a valid Sri Lankan phone number.'); isValid = false; }
                if (values.address.length < 10) { setFieldError('address', 'Add a clearer delivery address.'); isValid = false; }
                if (!values.city) { setFieldError('city', 'City is required.'); isValid = false; }
                if (!values.province) { setFieldError('province', 'Province is required.'); isValid = false; }
                if (!values.town) { setFieldError('town', 'Town is required.'); isValid = false; }
                if (!/^\d{5}$/.test(values.postal_code)) { setFieldError('postal_code', 'Postal code should contain 5 digits.'); isValid = false; }

                return isValid;
            };

            const placeCheckoutOrder = async () => {
                if (!validateForm() || !activeItems.length) return;
                if (activeItems.some((item) => Number(item.stock || 0) <= 0)) {
                    setStatusMessage('Remove out of stock items before checkout.', true);
                    alert('Remove out of stock items before checkout.');
                    return;
                }

                const shippingMethod = shippingOptions?.querySelector('input[name="shipping_method"]:checked')?.value || 'standard';
                const paymentMethod = paymentOptions?.querySelector('input[name="payment_method"]:checked')?.value || 'card';
                const formData = new FormData(checkoutForm);
                formData.append('shipping_method', shippingMethod);
                formData.append('payment_method', paymentMethod);
                formData.append('cart_items', JSON.stringify(activeItems));

                checkoutSubmitBtn.disabled = true;
                checkoutSubmitBtn.textContent = 'Preparing...';
                setStatusMessage('Preparing your confirmation page...');

                try {
                    const response = await fetch(checkoutStoreRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    if (!response.ok) {
                        const payload = await response.json().catch(() => ({}));
                        throw new Error(payload.message || 'Unable to place your order.');
                    }

                    const payload = await response.json();
                    if (!payload?.redirect_url) {
                        throw new Error('Unable to prepare confirmation page.');
                    }

                    window.location.assign(payload.redirect_url);
                    return;
                } catch (error) {
                    setStatusMessage(error.message || 'Unable to place your order.', true);
                    alert(error.message || 'Unable to place your order.');
                } finally {
                    checkoutSubmitBtn.disabled = false;
                    checkoutSubmitBtn.textContent = 'Continue To Payment';
                }
            };

            shippingOptions?.addEventListener('change', () => {
                syncShippingMode();
                renderSelectTiles(shippingOptions);
                renderCheckoutSummary();
            });
            paymentOptions?.addEventListener('change', () => {
                renderSelectTiles(paymentOptions);
            });
            checkoutSubmitBtn?.addEventListener('click', placeCheckoutOrder);

            renderSelectTiles(shippingOptions);
            renderSelectTiles(paymentOptions);
            renderCheckoutSummary();
        })();
    </script>
</body>
</html>
