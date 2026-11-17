<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Product Details</title>
    <link rel="icon" type="image/png" href="{{ asset('images/web_logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #222; background: #fff; overflow-x: hidden; }
        button, input, textarea, select { font-family: inherit; }
        .page-hero { padding: 58px 20px 38px; background: #f8f6f1; text-align: center; border-bottom: 1px solid #eadcc0; }
        .page-hero h1 { font-size: clamp(2rem, 3.4vw, 3rem); color: #1f1f1f; margin-bottom: 8px; }
        .page-hero p { color: #6a6254; line-height: 1.7; }
        .wrap { max-width: 1180px; margin: 0 auto; padding: 34px 20px 72px; }
        .product-layout { display: grid; grid-template-columns: minmax(320px, .92fr) 1.08fr; gap: 28px; align-items: start; }
        .product-media {
            background: linear-gradient(180deg, #f6f2eb 0%, #f1ece2 100%);
            border: 1px solid #e4d4b2;
            border-radius: 18px;
            padding: 12px;
            display: grid;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(86, 68, 28, 0.05);
        }
        .media-toggle-group { display: inline-flex; gap: 8px; flex-wrap: wrap; align-self: start; }
        .media-toggle {
            border: 1px solid #e1cda0;
            background: rgba(255,255,255,.82);
            color: #5d4722;
            border-radius: 999px;
            padding: 10px 15px;
            font-weight: 850;
            letter-spacing: .2px;
            cursor: pointer;
            transition: transform .15s ease, background .15s ease, color .15s ease, box-shadow .15s ease;
        }
        .media-toggle.active {
            background: #c4a46a;
            color: #fff;
            border-color: #c4a46a;
            box-shadow: 0 8px 18px rgba(188, 156, 94, 0.22);
        }
        .media-toggle:hover { background: #fff7eb; transform: translateY(-1px); }
        .media-stage {
            position: relative;
            min-height: 620px;
        }
        .media-panel {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            min-width: 0;
            display: none;
            box-shadow: 0 10px 26px rgba(86, 68, 28, 0.08);
        }
        .media-panel.is-active { display: block; }
        .media-image {
            width: 100%;
            height: 560px;
            object-fit: contain;
            display: block;
            background: #fff;
        }
        .viewer360 {
            background: #fff;
        }
        .viewer360-stage {
            position: relative;
            min-height: 560px;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            user-select: none;
            touch-action: none;
            box-shadow: 0 12px 30px rgba(86, 68, 28, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .viewer360-stage img {
            width: 100%;
            height: 540px;
            object-fit: contain;
            display: block;
            background: #fff;
            transform: scale(1.08) translateY(0);
            transform-origin: center center;
            cursor: grab;
            pointer-events: auto;
        }
        .viewer360-stage.dragging img { cursor: grabbing; }
        .viewer360-hint {
            position: absolute;
            left: 16px;
            bottom: 16px;
            font-size: .75rem;
            color: #fff;
            background: rgba(37, 29, 16, .52);
            border-radius: 999px;
            padding: 7px 11px;
            backdrop-filter: blur(5px);
        }
        .viewer360-controls {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 8px;
            padding-left: 2px;
        }
        .viewer360-btn {
            border: none;
            background: rgba(255,255,255,.82);
            color: #5d4722;
            border-radius: 999px;
            padding: 10px 12px;
            font-weight: 850;
            cursor: pointer;
            transition: transform .15s ease, background .15s ease, box-shadow .15s ease, color .15s ease;
        }
        .viewer360-btn:hover { background: #fff7eb; transform: translateY(-1px); box-shadow: 0 6px 14px rgba(133, 101, 40, .06); }
        #viewerPanel:fullscreen,
        #viewerPanel:-webkit-full-screen,
        #viewerPanel.is-fullscreen {
            position: fixed;
            inset: 0;
            z-index: 4000;
            width: 100vw;
            height: 100vh;
            background: rgba(18, 14, 8, 0.96);
            padding: clamp(16px, 2vw, 28px);
            margin: 0;
            border-radius: 0;
            display: grid;
            grid-template-rows: minmax(0, 1fr) auto;
            align-items: stretch;
            justify-items: stretch;
            overflow: hidden;
            box-sizing: border-box;
        }
        #viewerPanel:fullscreen .viewer360-stage,
        #viewerPanel:-webkit-full-screen .viewer360-stage,
        #viewerPanel.is-fullscreen .viewer360-stage {
            width: 100%;
            flex: 1 1 auto;
            min-height: 0;
            height: 100%;
            margin: 0;
            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        #viewerPanel:fullscreen .viewer360-stage img,
        #viewerPanel:-webkit-full-screen .viewer360-stage img,
        #viewerPanel.is-fullscreen .viewer360-stage img {
            width: min(88vw, 1180px);
            height: min(68vh, 760px);
            transform: scale(1);
            transform-origin: center center;
            object-position: center center;
        }
        #viewerPanel:fullscreen .viewer360-hint,
        #viewerPanel:-webkit-full-screen .viewer360-hint,
        #viewerPanel.is-fullscreen .viewer360-hint {
            display: none;
        }
        #viewerPanel:fullscreen .viewer360-controls,
        #viewerPanel:-webkit-full-screen .viewer360-controls,
        #viewerPanel.is-fullscreen .viewer360-controls {
            display: flex;
            position: relative;
            margin: 0 auto;
            padding: 6px 0 0;
            transform: none;
            width: min(92vw, 760px);
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            z-index: 2;
        }
        #viewerPanel:fullscreen .viewer360,
        #viewerPanel:-webkit-full-screen .viewer360,
        #viewerPanel.is-fullscreen .viewer360 {
            height: 100%;
            background: transparent;
            width: 100%;
            position: relative;
            display: grid;
            flex-direction: column;
            align-items: stretch;
            justify-content: stretch;
            gap: 14px;
            grid-template-rows: minmax(0, 1fr) auto;
        }
        #viewerPanel:fullscreen .viewer360-btn,
        #viewerPanel:-webkit-full-screen .viewer360-btn,
        #viewerPanel.is-fullscreen .viewer360-btn {
            background: rgba(255,255,255,.9);
            flex: 0 1 auto;
        }
        .product-type { color: #9a7a42; font-size: .82rem; font-weight: 800; letter-spacing: .8px; text-transform: uppercase; margin-bottom: 8px; }
        .product-title { font-size: clamp(1.8rem, 2.6vw, 2.55rem); line-height: 1.18; margin-bottom: 8px; color: #171717; }
        .product-meta { color: #777; text-transform: uppercase; font-size: .86rem; letter-spacing: .5px; margin-bottom: 10px; }
        .rating-row { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 12px; color: #666; }
        .stars { color: #e28a4a; letter-spacing: 1px; }
        .stock-pill { display:inline-flex; align-items:center; padding:3px 7px; border-radius:999px; font-size:.58rem; font-weight:700; letter-spacing:.28px; text-transform:uppercase; line-height:1; white-space:nowrap; opacity:.9; }
        .stock-pill.in-stock { background:#edf7ee; color:#245f30; border:1px solid #c9e8ce; }
        .stock-pill.critical { background:#fff0e7; color:#b55a2d; border:1px solid #f1ccb5; }
        .stock-pill.out-of-stock { background:#f5e6e6; color:#a33; border:1px solid #edc8c8; }
        .price { font-size: 2.2rem; font-weight: 850; color: #111; margin-bottom: 12px; }
        .price-note { display: grid; gap: 8px; border: 1px solid #eadcc0; background: #fbf8f2; border-radius: 12px; padding: 14px; margin-bottom: 16px; }
        .price-note strong { font-size: .9rem; text-transform: uppercase; letter-spacing: .45px; color: #7b6239; }
        .price-note p { color: #51493e; line-height: 1.6; font-size: .95rem; }
        .pricing-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .pricing-item { background: #fff; border: 1px solid #eee0c5; border-radius: 10px; padding: 10px 12px; }
        .pricing-item span { display: block; color: #8a7a60; font-size: .76rem; text-transform: uppercase; letter-spacing: .45px; margin-bottom: 4px; }
        .pricing-item strong { color: #1f1f1f; font-size: .98rem; }
        .desc { color: #525252; line-height: 1.8; margin-bottom: 16px; }
        .actions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
            align-items: start;
        }
        .action-stack {
            display: grid;
            gap: 10px;
            align-content: start;
        }
        .action-spacer {
            min-height: 73px;
        }
        .actions form { display: flex; flex-direction: column; height: auto; }
        .actions > * { width: 100%; align-self: start; }
        .actions .btn {
            width: 100%;
            min-height: 56px;
            padding: 11px 14px;
            line-height: 1.15;
            border-radius: 14px;
            font-size: .9rem;
            font-weight: 750;
            letter-spacing: .1px;
            box-shadow: 0 8px 18px rgba(86, 68, 28, 0.06);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .actions .btn i { font-size: .9rem; }
        .actions form:first-child { display: grid; gap: 10px; align-content: start; }
        .actions form:first-child .btn { margin-top: 0; }
        .actions form:nth-child(2),
        .actions form:nth-child(3) { justify-content: flex-start; }
        .size-picker { display: grid; gap: 6px; width: 100%; margin: 0 0 2px; }
        .size-picker label { font-weight: 750; font-size: .78rem; color: #5d4d31; text-transform: uppercase; letter-spacing: .4px; }
        .size-picker select { width: 100%; border: 1px solid #ddd3c1; border-radius: 10px; padding: 10px 12px; font-size: .94rem; background: #fff; }
        .cart-success { margin-bottom: 14px; padding: 12px 14px; border-radius: 10px; background: #edf7ee; border: 1px solid #c9e8ce; color: #245f30; }
        .stock-alert { margin-bottom: 14px; padding: 12px 14px; border-radius: 10px; background: #f5e6e6; border: 1px solid #edc8c8; color: #a33; }
        .btn { border: none; border-radius: 8px; padding: 12px 18px; cursor: pointer; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
        .btn.primary { background: #bfa16a; color: #fff; }
        .btn.secondary { background: #f3e5cb; color: #5d4722; }
        .login-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(18, 14, 8, 0.58);
            backdrop-filter: blur(4px);
            z-index: 2000;
            padding: 20px;
        }
        .login-modal.open { display: flex; }
        .login-modal-card {
            width: min(100%, 440px);
            background: #fff;
            border-radius: 18px;
            border: 1px solid #eadcc0;
            box-shadow: 0 24px 60px rgba(0,0,0,.22);
            padding: 24px 22px 20px;
        }
        .login-modal-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }
        .login-modal-head h3 {
            font-size: 1.35rem;
            color: #1c1c1c;
            margin: 0;
        }
        .login-modal-close {
            border: none;
            background: #f3e5cb;
            color: #5d4722;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: inline-grid;
            place-items: center;
            flex-shrink: 0;
        }
        .login-modal p {
            color: #5e5e5e;
            line-height: 1.7;
            margin-bottom: 18px;
        }
        .login-modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }
        .info-grid { display: grid; grid-template-columns: 160px 1fr; row-gap: 8px; column-gap: 12px; margin-top: 10px; max-width: 520px; }
        .info-grid strong { color: #2a2a2a; }
        .info-grid span { color: #585858; }
        .tabs { margin-top: 34px; border-top: 1px solid #eadcc0; padding-top: 18px; }
        .tab-head { display: flex; gap: 24px; border-bottom: 1px solid #e8e8e8; margin-bottom: 16px; flex-wrap: wrap; }
        .tab-btn { border: none; background: transparent; color: #8a8a8a; padding: 0 0 10px; cursor: pointer; font-size: 1rem; font-weight: 750; }
        .tab-btn.active { color: #171717; border-bottom: 2px solid #bfa16a; }
        .tab-pane { display: none; color: #4c4c4c; line-height: 1.75; }
        .tab-pane.active { display: block; }
        .review-success { background: #edf7ee; border: 1px solid #c9e8ce; color: #245f30; border-radius: 10px; padding: 12px 14px; margin-bottom: 14px; }
        .review-error { background: #fff0ea; border: 1px solid #f0d2c7; color: #9c4d3d; border-radius: 10px; padding: 12px 14px; margin-bottom: 14px; }
        .verified-badge { display: inline-flex; align-items: center; gap: 6px; margin-top: 6px; padding: 6px 10px; border-radius: 999px; background: #edf7ee; border: 1px solid #c9e8ce; color: #245f30; font-size: .78rem; font-weight: 800; letter-spacing: .3px; text-transform: uppercase; }
        .reviews-summary { border: 1px solid #e8e8e8; background: #fafafa; border-radius: 10px; padding: 14px; margin-bottom: 14px; display: grid; grid-template-columns: 220px 1fr; gap: 18px; align-items: start; }
        .score-box { text-align: center; }
        .score { font-size: 2.8rem; font-weight: 850; color: #bfa16a; line-height: 1; margin: 6px 0; }
        .bar-row { display: grid; grid-template-columns: 84px 1fr 42px; gap: 10px; align-items: center; margin-bottom: 8px; }
        .bar-track { height: 10px; background: #ececec; border-radius: 999px; overflow: hidden; }
        .bar-fill { height: 100%; background: repeating-linear-gradient(135deg, #e0ad34, #e0ad34 4px, #d99f20 4px, #d99f20 8px); }
        .review-item { border-top: 1px solid #ececec; padding-top: 14px; margin-top: 14px; }
        .review-item .name { font-weight: 800; color: #202020; margin-bottom: 2px; }
        .review-item .date { color: #9a9a9a; font-size: .9rem; margin-bottom: 8px; }
        .review-form { margin-top: 20px; border-top: 1px solid #ececec; padding-top: 18px; }
        .review-form h4 { font-size: 1.5rem; margin-bottom: 8px; }
        .review-note { color: #5c5c5c; margin-bottom: 14px; line-height: 1.6; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin: 12px 0; }
        .field label { display: block; font-weight: 750; font-size: .86rem; color: #5d4d31; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .4px; }
        .field input, .field textarea, .field select { width: 100%; border: 1px solid #ddd3c1; border-radius: 8px; padding: 11px 12px; font-size: .96rem; }
        .field textarea { min-height: 130px; resize: vertical; }
        .field.full { grid-column: 1 / -1; }
        .form-error { color: #a33; font-size: .9rem; margin-top: 5px; }
        @media (max-width: 860px) {
            .product-layout { grid-template-columns: 1fr; }
            .actions { grid-template-columns: 1fr; }
            .action-spacer { display: none; }
            .media-toggle-group { width: 100%; }
            .media-toggle { flex: 1 1 0; justify-content: center; }
            .media-stage { min-height: 360px; }
            .media-image { height: 360px; }
            .viewer360-stage img {
                height: 320px;
                transform: scale(1.34) translateY(-8px);
            }
            .reviews-summary { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<x-navbar />


<main class="wrap">
    <section class="product-layout">
        <div class="product-media">
            @if ($has360Preview)
                <div class="media-toggle-group" data-media-toggle-group>
                    <button class="media-toggle active" type="button" data-media-target="stillPanel">Main image</button>
                    <button class="media-toggle" type="button" data-media-target="viewerPanel">360 view</button>
                </div>
            @endif

            <div class="media-stage">
                <div class="media-panel is-active" id="stillPanel" data-media-panel="stillPanel">
                    <img class="media-image" src="{{ $imageUrl }}" alt="{{ $product->name }}">
                </div>

                @if ($has360Preview)
                    <div class="media-panel" id="viewerPanel" data-media-panel="viewerPanel">
                        <div class="viewer360" data-viewer360>
                            <div class="viewer360-stage" data-viewer360-stage>
                                <img
                                    src="{{ $preview360Images[0] }}"
                                    alt="{{ $product->name }} 360 preview frame 1"
                                    draggable="false"
                                    data-viewer360-image
                                >
                                <div class="viewer360-hint">Drag left or right to rotate</div>
                            </div>
                            <div class="viewer360-controls">
                                <button class="viewer360-btn" type="button" data-viewer360-prev>Previous</button>
                                <button class="viewer360-btn" type="button" data-viewer360-toggle>Auto rotate</button>
                                <button class="viewer360-btn" type="button" data-viewer360-next>Next</button>
                                <button class="viewer360-btn" type="button" data-viewer360-fullscreen aria-label="Fullscreen"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <p class="product-type">{{ $productType }}</p>
            <h2 class="product-title">{{ $product->name }}</h2>
            <p class="product-meta">{{ $metaLine ?: 'Product' }}</p>
            <div class="rating-row">
                <span class="stars">{{ str_repeat('★', (int) round($averageRating)) }}{{ str_repeat('☆', 5 - (int) round($averageRating)) }}</span>
                <span>{{ $reviewCount }} {{ \Illuminate\Support\Str::plural('review', $reviewCount) }}</span>
                <span class="stock-pill {{ strtolower(str_replace(' ', '-', $stockStatus ?? 'in-stock')) }}">{{ $stockLabel ?? 'In Stock' }}</span>
            </div>
            <p class="price">LKR {{ number_format((float) $product->price, 2) }}</p>
            @if ($pricingSummary)
                <div class="price-note">
                    <strong>Live jewellery pricing</strong>
                    <p class="desc">{{ $product->description ?: 'A carefully selected product with refined finishing and timeless styling.' }}</p>
                    <div class="pricing-grid">
                        <div class="pricing-item">
                            <span>Metal rate</span>
                            <strong>@if (!is_null($pricingSummary['rate_per_gram'] ?? null)) LKR {{ number_format((float) $pricingSummary['rate_per_gram'], 2) }}/g @else Unavailable @endif</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Metal</span>
                            <strong>{{ $product->jewellery->metal ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Gemstone</span>
                            <strong>{{ $product->jewellery->gemstone ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Occasion</span>
                            <strong>{{ $product->jewellery->occasion ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Gender</span>
                            <strong>{{ $product->jewellery->gender ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Updated</span>
                            <strong>{{ $pricingSummary['updated_at']?->format('d M Y, h:i A') ?? 'Live' }}</strong>
                        </div>
                    </div>
                </div>
            @elseif ($product->gem)
                <div class="price-note">
                    <strong>Gem details</strong>
                    <p class="desc">{{ $product->description ?: 'A carefully selected gemstone with refined finishing and timeless styling.' }}</p>
                    <div class="pricing-grid">
                        <div class="pricing-item">
                            <span>Cut</span>
                            <strong>{{ $product->gem->cut ?? $product->gem->shape ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Carat</span>
                            <strong>{{ $product->gem->carat_weight ? $product->gem->carat_weight.' ct' : 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Color</span>
                            <strong>{{ $product->gem->color ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Updated</span>
                            <strong>Live</strong>
                        </div>
                    </div>
                </div>
            @elseif ($product->collection)
                <div class="price-note">
                    <strong>Collection details</strong>
                    <p class="desc">{{ $product->description ?: 'A carefully selected collection piece with refined finishing and timeless styling.' }}</p>
                    <div class="pricing-grid">
                        <div class="pricing-item">
                            <span>Occasion</span>
                            <strong>{{ $product->collection->occasion ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Gemstone</span>
                            <strong>{{ $product->collection->gemstone ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Gender</span>
                            <strong>{{ $product->collection->gender ?? 'Not set' }}</strong>
                        </div>
                        <div class="pricing-item">
                            <span>Metal</span>
                            <strong>{{ $product->collection->metal ?? 'Not set' }}</strong>
                        </div>
                    </div>
                </div>
            @endif
           
            @if (session('cart_success'))
                <div class="cart-success">{{ session('cart_success') }}</div>
            @endif
            @if (session('cart_error'))
                <div class="cart-success" style="background:#f5e6e6;border-color:#edc8c8;color:#a33;">{{ session('cart_error') }}</div>
            @endif
            @if (session('wishlist_success'))
                <div class="cart-success">{{ session('wishlist_success') }}</div>
            @endif
            <div id="buyNowStatus" class="stock-alert" style="display:none;" aria-live="polite"></div>
            <div class="actions">
                @php($canPurchase = auth()->check() && auth()->user()->role === 'customer')
                @if ($canPurchase)
                    <div class="action-stack">
                        @if ($isInCart ?? false)
                            <form method="POST" action="{{ route('cart.items.destroy', $cartItemId) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn primary" type="submit">
                                    <i class="fas fa-cart-shopping"></i>
                                    Remove from cart
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('cart.items.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                <input type="hidden" name="quantity" value="1">
                                @if (!empty($sizeOptions ?? []) && ($product->jewellery || !empty($sizeLabel ?? '')))
                                    <div class="size-picker">
                                        <label for="sizeValue">{{ $sizeLabel ?? 'Size' }}</label>
                                        <select id="sizeValue" name="size_value" required>
                                            <option value="" disabled selected hidden>Select a size</option>
                                            @foreach($sizeOptions as $sizeOption)
                                                <option value="{{ $sizeOption }}">{{ $sizeOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <button class="btn primary" type="submit" {{ ($stock ?? 0) <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-cart-shopping"></i>
                                    {{ ($stock ?? 0) <= 0 ? 'Out of Stock' : 'Add to cart' }}
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="action-stack">
                        <div class="action-spacer"></div>
                        @if ($isWishlisted)
                            <form method="POST" action="{{ route('wishlist.items.destroy', $wishlistItemId) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn secondary" type="submit">
                                    <i class="fas fa-heart"></i>
                                    Remove from wishlist
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('wishlist.items.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                <button class="btn secondary" type="submit">
                                    <i class="fas fa-heart"></i>
                                    Add to wishlist
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="action-stack">
                        <div class="action-spacer"></div>
                        <button class="btn secondary js-buy-now" type="button" data-stock="{{ (int) ($stock ?? 0) }}">
                            <i class="fas fa-bag-shopping"></i>
                            Buy It Now
                        </button>
                    </div>
                @else
                    <div class="action-stack">
                        <div class="action-spacer"></div>
                        <button class="btn primary js-login-gate" type="button" data-login-url="{{ route('signin') }}">
                            <i class="fas fa-cart-shopping"></i>
                            Add to cart
                        </button>
                    </div>
                    <div class="action-stack">
                        <div class="action-spacer"></div>
                        <button class="btn secondary js-login-gate" type="button" data-login-url="{{ route('signin') }}">
                            <i class="fas fa-heart"></i>
                            Add to wishlist
                        </button>
                    </div>
                    <div class="action-stack">
                        <div class="action-spacer"></div>
                        <button class="btn secondary js-login-gate" type="button" data-login-url="{{ route('signin') }}">
                            <i class="fas fa-bag-shopping"></i>
                            Buy It Now
                        </button>
                    </div>
                @endif
            </div>
            @if (($stock ?? 0) <= 5 && ($stock ?? 0) > 0)
                <div class="cart-success" style="background:#fff0e7;border-color:#f1ccb5;color:#b55a2d;">Only {{ $stock }} left in stock. Order soon.</div>
            @endif

        </div>
    </section>

    <section class="tabs">
        <div class="tab-head">
            <button class="tab-btn active" data-tab="descTab" type="button">Description</button>
            <button class="tab-btn" data-tab="infoTab" type="button">Additional Information</button>
            <button class="tab-btn" data-tab="reviewTab" type="button">Reviews ({{ $reviewCount }})</button>
        </div>

        <div id="descTab" class="tab-pane active">
            <p>{{ $product->description ?: 'This piece blends premium finishing with elegant styling for everyday and occasion wear.' }}</p>
        </div>

        <div id="infoTab" class="tab-pane">
            <div class="info-grid">
                @foreach ($attributes as $label => $value)
                    @if ($value)
                        <strong>{{ $label }}</strong><span>{{ $value }}</span>
                    @endif
                @endforeach
            </div>
        </div>

        <div id="reviewTab" class="tab-pane">
            @if (session('review_success'))
                <div class="review-success">{{ session('review_success') }}</div>
            @endif
            @if (session('review_error'))
                <div class="review-error">{{ session('review_error') }}</div>
            @endif

            <div class="reviews-summary">
                <div class="score-box">
                    <p>{{ $reviewCount }} verified {{ \Illuminate\Support\Str::plural('rating', $reviewCount) }}</p>
                    <p class="score">{{ number_format($averageRating, 2) }}/5</p>
                    <p class="stars">{{ str_repeat('★', (int) round($averageRating)) }}{{ str_repeat('☆', 5 - (int) round($averageRating)) }}</p>
                </div>
                <div>
                    <?php foreach (range(5, 1) as $rating): ?>
                        <?php
                            $count = $ratingDistribution[$rating] ?? 0;
                            $percent = $reviewCount ? round(($count / $reviewCount) * 100) : 0;
                        ?>
                        <div class="bar-row">
                            <span class="stars">{{ str_repeat('★', $rating) }}{{ str_repeat('☆', 5 - $rating) }}</span>
                            <div class="bar-track"><div class="bar-fill" style="width:{{ $percent }}%"></div></div>
                            <span>{{ $percent }}%</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            @forelse ($reviews as $review)
                <article class="review-item">
                    <p class="stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</p>
                    <p class="name">{{ $review->name }}</p>
                    @if ($review->orderItem)
                        <span class="verified-badge"><i class="fas fa-circle-check"></i> Verified Purchase</span>
                    @endif
                    <p class="date">{{ $review->created_at->format('F d, Y') }}</p>
                    <p>{{ $review->review }}</p>
                </article>
            @empty
                <p>No reviews yet. Be the first to review this product.</p>
            @endforelse

            @auth
                @if (($canReview ?? false) && !empty($eligibleOrderItemId))
                <form class="review-form" method="POST" action="{{ route('products.reviews.store', $product) }}">
                    @csrf
                    <input type="hidden" name="order_item_id" value="{{ $eligibleOrderItemId }}">
                    <h4>Write a review</h4>
                    <p class="review-note">Only verified buyers can leave a review for this product.</p>
                    <div class="form-grid">
                        <div class="field">
                            <label for="rating">Rating</label>
                            <select id="rating" name="rating" required>
                                <option value="">Select rating</option>
                                @foreach ([5, 4, 3, 2, 1] as $rating)
                                    <option value="{{ $rating }}" @selected(old('rating') == $rating)>{{ $rating }} Stars</option>
                                @endforeach
                            </select>
                            @error('rating') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="field">
                            <label for="name">Name</label>
                            <input id="name" name="name" value="{{ old('name', auth()->user()?->first_name) }}" required>
                            @error('name') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', auth()->user()?->email) }}" required>
                            @error('email') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="field full">
                            <label for="review">Review</label>
                            <textarea id="review" name="review" required>{{ old('review') }}</textarea>
                            @error('review') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <button class="btn primary" type="submit">Submit Review</button>
                </form>
                @else
                <div class="review-form">
                    <h4>Write a review</h4>
                    <p class="review-note">{{ $reviewEligibilityMessage ?? 'Only verified buyers can leave a review for this item.' }}</p>
                </div>
                @endif
            @else
                <div class="review-form">
                    <h4>Write a review</h4>
                    <button class="btn primary js-login-gate" type="button" data-login-url="{{ route('signin') }}">
                        Please sign in to leave a review
                    </button>
                </div>
            @endauth
        </div>
    </section>
</main>

<x-footer />

<div id="loginModal" class="login-modal" aria-hidden="true">
    <div class="login-modal-card" role="dialog" aria-modal="true" aria-labelledby="loginModalTitle">
        <div class="login-modal-head">
            <h3 id="loginModalTitle">Please log in first</h3>
            <button class="login-modal-close" type="button" aria-label="Close dialog" data-login-modal-close>
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p>You can view this product without signing in. To add it to your cart, save it to your wishlist, or leave a review, please sign in first.</p>
        <div class="login-modal-actions">
            <button class="btn secondary" type="button" data-login-modal-close>Cancel</button>
            <a class="btn primary" href="{{ route('signin') }}" id="loginModalLink">Sign In</a>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(item => item.classList.remove('active'));
        button.classList.add('active');
        document.getElementById(button.dataset.tab)?.classList.add('active');
    });
});

const loginModal = document.getElementById('loginModal');
const loginModalLink = document.getElementById('loginModalLink');
const buyNowStatus = document.getElementById('buyNowStatus');
const checkoutStorageKey = 'pg_checkout_session';
const checkoutRoute = @json(route('checkout'));
const preview360Images = @json($preview360Images);
const productName = @json($product->name);
const mediaToggleButtons = document.querySelectorAll('[data-media-target]');
const mediaPanels = document.querySelectorAll('[data-media-panel]');
const directCheckoutItem = {
    id: @json($product->product_id),
    product_id: @json($product->product_id),
    name: @json($product->name),
    description: @json($product->description),
    image: @json($imageUrl),
    price: @json((float) $product->price),
    quantity: 1,
    stock: @json($stock),
    stock_status: @json($stockStatus ?? 'in-stock'),
    stock_label: @json($stockLabel ?? 'in-stock'),
    targetUrl: @json(route('products.show', $product)),
};

function openLoginModal(loginUrl) {
    loginModalLink.href = loginUrl || '{{ route('signin') }}';
    loginModal.classList.add('open');
    loginModal.setAttribute('aria-hidden', 'false');
}

function closeLoginModal() {
    loginModal.classList.remove('open');
    loginModal.setAttribute('aria-hidden', 'true');
}

document.querySelectorAll('[data-login-modal-close]').forEach((button) => {
    button.addEventListener('click', closeLoginModal);
});

loginModal.addEventListener('click', (event) => {
    if (event.target === loginModal) {
        closeLoginModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeLoginModal();
    }
});

document.querySelectorAll('.js-login-gate').forEach((button) => {
    button.addEventListener('click', () => {
        const loginUrl = button.dataset.loginUrl || '{{ route('signin') }}';
        openLoginModal(loginUrl);
    });
});

document.querySelectorAll('.js-buy-now').forEach((button) => {
    button.addEventListener('click', () => {
        const stock = Number(button.dataset.stock || 0);
        if (!stock || stock <= 0) {
            if (buyNowStatus) {
                buyNowStatus.textContent = 'Out of stock';
                buyNowStatus.style.display = 'block';
            }
            return;
        }
        if (buyNowStatus) {
            buyNowStatus.style.display = 'none';
            buyNowStatus.textContent = '';
        }

        localStorage.setItem(checkoutStorageKey, JSON.stringify({
            source: 'product-buy-now',
            createdAt: new Date().toISOString(),
            items: [directCheckoutItem],
        }));

        window.location.href = checkoutRoute;
    });
});

if (mediaToggleButtons.length && mediaPanels.length) {
    const setActivePanel = (panelId) => {
        mediaPanels.forEach((panel) => {
            panel.classList.toggle('is-active', panel.id === panelId);
        });

        mediaToggleButtons.forEach((button) => {
            const isActive = button.dataset.mediaTarget === panelId;
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    };

    mediaToggleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setActivePanel(button.dataset.mediaTarget);
        });
    });

    setActivePanel('stillPanel');
}

if (preview360Images.length > 1) {
    const viewer = document.querySelector('[data-viewer360]');
    const viewerPanel = document.getElementById('viewerPanel');
    const stage = document.querySelector('[data-viewer360-stage]');
    const image = document.querySelector('[data-viewer360-image]');
    const prevButton = document.querySelector('[data-viewer360-prev]');
    const nextButton = document.querySelector('[data-viewer360-next]');
    const toggleButton = document.querySelector('[data-viewer360-toggle]');
    const fullscreenButton = document.querySelector('[data-viewer360-fullscreen]');

    let frameIndex = 0;
    let isDragging = false;
    let dragStartX = 0;
    let autoRotateTimer = null;

    const updateFrame = (nextIndex) => {
        frameIndex = (nextIndex + preview360Images.length) % preview360Images.length;
        image.src = preview360Images[frameIndex];
        image.alt = `${productName} 360 preview frame ${frameIndex + 1}`;
    };

    const stopAutoRotate = () => {
        if (autoRotateTimer) {
            window.clearInterval(autoRotateTimer);
            autoRotateTimer = null;
        }
        toggleButton.textContent = 'Auto rotate';
    };

    const startAutoRotate = () => {
        stopAutoRotate();
        autoRotateTimer = window.setInterval(() => {
            updateFrame(frameIndex + 1);
        }, 160);
        toggleButton.textContent = 'Pause';
    };

    const toggleAutoRotate = () => {
        if (autoRotateTimer) {
            stopAutoRotate();
            return;
        }

        startAutoRotate();
    };

    const syncFullscreenButton = () => {
        const isFullscreen = document.fullscreenElement === viewerPanel
            || document.webkitFullscreenElement === viewerPanel;

        viewerPanel.classList.toggle('is-fullscreen', isFullscreen);
        document.body.style.overflow = isFullscreen ? 'hidden' : '';
        fullscreenButton.innerHTML = isFullscreen
            ? '<i class="fas fa-compress"></i>'
            : '<i class="fas fa-expand"></i>';
        fullscreenButton.setAttribute('aria-label', isFullscreen ? 'Exit fullscreen' : 'Fullscreen');
    };

    const toggleFullscreen = async () => {
        if (!viewerPanel) {
            return;
        }

        const isFullscreen = document.fullscreenElement === viewerPanel
            || document.webkitFullscreenElement === viewerPanel;

        try {
            if (isFullscreen) {
                if (document.exitFullscreen) {
                    await document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    await document.webkitExitFullscreen();
                }
                return;
            }

            if (viewerPanel.requestFullscreen) {
                await viewerPanel.requestFullscreen();
            } else if (viewerPanel.webkitRequestFullscreen) {
                await viewerPanel.webkitRequestFullscreen();
            }
        } catch (error) {
            // Ignore fullscreen failures and keep the viewer usable.
        }
    };

    const stepFromPointer = (clientX) => {
        const delta = clientX - dragStartX;

        if (Math.abs(delta) < 14) {
            return;
        }

        const direction = delta > 0 ? -1 : 1;
        updateFrame(frameIndex + direction);
        dragStartX = clientX;
    };

    const startDrag = (event) => {
        event.preventDefault();
        isDragging = true;
        dragStartX = event.clientX;
        stage.classList.add('dragging');
        stopAutoRotate();

        if (typeof stage.setPointerCapture === 'function') {
            try {
                stage.setPointerCapture(event.pointerId);
            } catch (error) {
                // Pointer capture is best-effort here.
            }
        }
    };

    preview360Images.forEach((src) => {
        const preloaded = new Image();
        preloaded.src = src;
    });

    prevButton.addEventListener('click', () => {
        stopAutoRotate();
        updateFrame(frameIndex - 1);
    });

    nextButton.addEventListener('click', () => {
        stopAutoRotate();
        updateFrame(frameIndex + 1);
    });

    toggleButton.addEventListener('click', toggleAutoRotate);
    fullscreenButton?.addEventListener('click', toggleFullscreen);

    stage.addEventListener('pointerdown', startDrag);
    image.addEventListener('pointerdown', startDrag);

    const handlePointerMove = (event) => {
        if (!isDragging) {
            return;
        }

        stepFromPointer(event.clientX);
    };

    const endDrag = () => {
        isDragging = false;
        stage.classList.remove('dragging');
    };

    window.addEventListener('pointermove', handlePointerMove);
    window.addEventListener('pointerup', endDrag);
    window.addEventListener('pointercancel', endDrag);
    document.addEventListener('fullscreenchange', syncFullscreenButton);
    document.addEventListener('webkitfullscreenchange', syncFullscreenButton);

    viewer.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') {
            event.preventDefault();
            stopAutoRotate();
            updateFrame(frameIndex - 1);
        }

        if (event.key === 'ArrowRight') {
            event.preventDefault();
            stopAutoRotate();
            updateFrame(frameIndex + 1);
        }
    });

    viewer.setAttribute('tabindex', '0');
    updateFrame(0);
    syncFullscreenButton();
}
</script>
</body>
</html>
