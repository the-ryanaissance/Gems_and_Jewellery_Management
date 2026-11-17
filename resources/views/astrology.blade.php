<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astrology | Pinwntha Gems</title>
    <link rel="icon" type="image/png" href="{{ asset('images/web_logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{
            --bg:#ffffff;
            --panel:#ffffff;
            --panel-soft:#fbfaf6;
            --line:#eee3d3;
            --text:#241d16;
            --muted:#6d6357;
            --gold:#b68c47;
            --green:#214841;
            --shadow:0 16px 40px rgba(36, 28, 17, .08);
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at top left, rgba(182,140,71,.08), transparent 24%),
                radial-gradient(circle at top right, rgba(47,111,101,.08), transparent 26%),
                linear-gradient(180deg,#fff 0%,#fcfbf8 100%);
        }
        .astrology-page{
            width:min(1320px,94vw);
            margin:0 auto;
            padding:24px 0 60px;
            display:grid;
            gap:22px;
        }
        .hero{
            position:relative;
            overflow:hidden;
            min-height:64vh;
            border-radius:34px;
            background:#101715;
            box-shadow:var(--shadow);
        }
        .hero-banner{
            position:absolute;
            inset:0;
            padding:0;
        }
        .hero-banner img{
            width:100%;
            height:100%;
            object-fit:cover;
            object-position:center center;
            display:block;
        }
        .hero-overlay{
            position:absolute;
            inset:0;
            background:linear-gradient(135deg, rgba(16, 23, 21, .55), rgba(16, 23, 21, .18));
            pointer-events:none;
        }
        .hero-copy{
            position:relative;
            z-index:2;
            height:100%;
            display:flex;
            align-items:flex-end;
            padding:40px;
            color:#fff;
            max-width:1100px;
        }
        .hero-copy-inner{
            display:grid;
            gap:12px;
            max-width:700px;
        }
        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:8px;
            width:max-content;
            padding:8px 12px;
            border-radius:999px;
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.18);
            color:#fff;
            font-size:.78rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:.12em;
            backdrop-filter:blur(12px);
        }
        .hero-copy h1{
            margin:0;
            font-family:Georgia,'Times New Roman',serif;
            font-size:clamp(2.6rem,4.4vw,4.8rem);
            line-height:1.03;
        }
        .hero-copy p{
            margin:0;
            color:rgba(255,255,255,.9);
            line-height:1.75;
            font-size:1.02rem;
        }
        .summary-row{
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:14px;
            margin-top:10px;
        }
        .summary-chip{
            padding:12px 14px;
            border-radius:18px;
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.16);
            backdrop-filter:blur(12px);
        }
        .summary-chip span{
            display:block;
            margin-bottom:6px;
            color:rgba(255,255,255,.72);
            font-size:.74rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:.1em;
        }
        .summary-chip strong{
            display:block;
            color:#fff;
            font-size:1rem;
            line-height:1.4;
        }
        .panel{
            background:var(--panel);
            border:1px solid var(--line);
            border-radius:28px;
            box-shadow:var(--shadow);
        }
        .section-card{
            padding:28px;
            display:grid;
            gap:20px;
        }
        .story-split{
            grid-template-columns:minmax(380px, 0.98fr) minmax(0,1.02fr);
            align-items:center;
            gap:28px;
        }
        .section-head{
            display:flex;
            align-items:end;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
        }
        .section-head h2{
            margin:0;
            font-family:Georgia,'Times New Roman',serif;
            font-size:1.55rem;
        }
        .section-head span{
            color:var(--muted);
            font-size:.92rem;
        }
        .section-media{
            position:relative;
            overflow:hidden;
            min-height:126px;
            border-radius:26px;
            background:var(--panel-soft);
            padding:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin-inline:auto;
            width:100%;
        }
        .sign-media{
            min-height:340px;
            max-width:72%;
        }
        .month-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            width:max-content;
            padding:8px 12px;
            border-radius:999px;
            background:#fff;
            border:1px solid var(--line);
            color:#7a5d31;
            font-size:.7rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:.1em;
        }
        .month-badge-wrap{
            display:flex;
            justify-content:flex-start;
            margin-bottom:4px;
        }
        .month-accent{
            background:linear-gradient(135deg, rgba(33,72,65,.08), rgba(182,140,71,.08));
        }
        .section-media img{
            width:100%;
            height:100%;
            max-width:none;
            max-height:none;
            object-fit:contain;
            object-position:center center;
            display:block;
        }
        .banner-media{
            width:100%;
            min-height:320px;
            padding:0;
            background:#101715;
        }
        .banner-media .banner-image{
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            object-fit:cover;
            object-position:center center;
            max-width:none;
            max-height:none;
        }
        .banner-media .banner-overlay{
            position:absolute;
            inset:0;
            background:linear-gradient(135deg, rgba(16,23,21,.68), rgba(16,23,21,.24));
        }
        .banner-symbol{
            position:absolute;
            left:20px;
            bottom:20px;
            width:96px;
            height:96px;
            padding:14px;
            border-radius:22px;
            background:rgba(255,255,255,.14);
            border:1px solid rgba(255,255,255,.16);
            backdrop-filter:blur(10px);
        }
        .banner-symbol img{
            width:100%;
            height:100%;
            max-width:none;
            max-height:none;
        }
        .section-content{
            display:grid;
            gap:12px;
            width:100%;
            margin-inline:0;
        }
        .section-content p{
            margin:0;
            color:var(--muted);
            line-height:1.75;
        }
        .meta-tags{
            display:flex;
            flex-wrap:wrap;
            gap:8px;
        }
        .tag{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 12px;
            border-radius:999px;
            background:#fff;
            border:1px solid var(--line);
            color:#7a5d31;
            font-size:.82rem;
            font-weight:700;
        }
        .choice-panel{
            padding:28px;
        }
        .choice-layout{
            display:grid;
            grid-template-columns:minmax(360px, 1.2fr) minmax(320px, .8fr);
            gap:24px;
            align-items:stretch;
        }
        .choice-banner{
            position:relative;
            overflow:hidden;
            min-height:360px;
            border-radius:26px;
            background:#101715;
        }
        .choice-banner img{
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            object-fit:cover;
            object-position:center center;
            max-width:none;
            max-height:none;
        }
        .choice-banner::after{
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(135deg, rgba(16,23,21,.62), rgba(16,23,21,.22));
        }
        .choice-panel h2{
            margin:0;
            font-family:Georgia,'Times New Roman',serif;
            font-size:1.65rem;
        }
        .choice-panel p{
            margin:0;
            color:var(--muted);
            line-height:1.7;
        }
        .choice-copy{
            display:grid;
            gap:16px;
            align-content:start;
        }
        .choice-row{
            display:grid;
            gap:10px;
        }
        .choice-row label{
            color:#8c6e3f;
            font-size:.78rem;
            font-weight:800;
            letter-spacing:.1em;
            text-transform:uppercase;
        }
        .choice-row select{
            height:48px;
            border:1px solid #d9c8ad;
            border-radius:14px;
            padding:0 14px;
            font:inherit;
            background:#fff;
            color:#2d241b;
            outline:none;
            transition:border .2s ease, box-shadow .2s ease;
        }
        .choice-row select:focus{
            border-color:#b68c47;
            box-shadow:0 0 0 3px rgba(182,140,71,.14);
        }
        .choice-result{
            padding:18px;
            border-radius:20px;
            background:linear-gradient(135deg,#fffdf8,#f7efe3);
            border:1px solid #efdcc0;
            display:grid;
            gap:8px;
            min-height:160px;
            align-content:center;
        }
        .choice-result span{
            color:#8c6e3f;
            font-size:.76rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:.1em;
        }
        .choice-result strong{
            font-size:1.15rem;
            color:#244b43;
        }
        .choice-result p{
            margin:0;
            color:var(--muted);
            line-height:1.65;
        }
        .product-section{
            padding:28px;
            display:grid;
            gap:18px;
        }
        .product-section-head{
            display:flex;
            align-items:end;
            justify-content:space-between;
            gap:14px;
            flex-wrap:wrap;
        }
        .product-section-head h2{
            margin:0;
            font-family:Georgia,'Times New Roman',serif;
            font-size:1.55rem;
        }
        .product-section-head p{
            margin:0;
            color:var(--muted);
            line-height:1.7;
        }
        .product-grid{
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:16px;
        }
        .product-card{
            display:block;
            overflow:hidden;
            border-radius:24px;
            border:1px solid var(--line);
            background:#fff;
            text-decoration:none;
            color:inherit;
            transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .product-stock {
            position: absolute;
            top: 14px;
            left: 14px;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            box-shadow: 0 10px 18px rgba(33, 28, 20, .08);
        }
        .product-stock.in-stock {
            background: rgba(237, 247, 238, .96);
            color: #245f30;
            border-color: #c9e8ce;
        }
        .product-stock.critical {
            background: rgba(255, 240, 231, .98);
            color: #b55a2d;
            border-color: #f1ccb5;
        }
        .product-stock.out-of-stock {
            background: rgba(245, 230, 230, .98);
            color: #a33;
            border-color: #edc8c8;
        }
        .product-card:hover{
            transform:translateY(-3px);
            border-color:#d8c19a;
            box-shadow:0 16px 32px rgba(33, 28, 20, .08);
        }
        .product-media{
            height:240px;
            background:#f2ede5;
        }
        .product-media img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }
        .product-body{
            padding:16px;
            display:grid;
            gap:6px;
        }
        .product-meta{
            color:#8c6e3f;
            font-size:.74rem;
            font-weight:800;
            letter-spacing:.1em;
            text-transform:uppercase;
        }
        .product-body h3{
            margin:0;
            font-size:1rem;
            line-height:1.35;
        }
        .product-body p{
            margin:0;
            color:var(--muted);
            line-height:1.6;
            font-size:.92rem;
        }
        .product-price{
            margin-top:4px;
            color:#214841;
            font-weight:800;
        }
        .empty{
            padding:18px;
            border-radius:20px;
            border:1px dashed #e4d4bc;
            color:var(--muted);
            line-height:1.7;
            background:#fff;
        }
        @media (max-width: 1100px){
            .product-grid,
            .summary-row{
                grid-template-columns:1fr 1fr;
            }
            .choice-layout,
            .story-split{
                grid-template-columns:1fr;
            }
        }
        @media (max-width: 760px){
            .astrology-page{
                width:min(100%,100vw);
                padding:0 0 40px;
            }
            .hero{
                border-radius:0;
                min-height:70vh;
            }
            .hero-banner{
                padding:10px;
            }
            .hero-copy{
                padding:22px;
            }
            .section-media{
                min-height:180px;
                padding:14px 14px;
                width:100%;
            }
            .banner-media,
            .choice-banner{
                min-height:220px;
            }
            .banner-symbol{
                width:68px;
                height:68px;
                left:14px;
                bottom:14px;
            }
            .summary-row,
            .product-grid{
                grid-template-columns:1fr;
            }
            .panel{
                border-radius:22px;
            }
        }
    </style>
</head>
<body>
    <x-navbar />

    @php
        $currentSignId = $currentSignCard['zodiac_id'] ?? $selectedSignId;
        $currentSignName = $currentSignCard['sign_name'] ?? 'Your zodiac sign';
        $birthstoneMonthName = $birthstoneCard['month_name'] ?? 'Birth month';
        $birthstoneProductName = $birthstoneCard['product_name'] ?? 'Birthstone';
        $recommendedProductLabel = $recommendedProductLabel ?? 'Birthstone';
    @endphp

    <main class="astrology-page">
        <section class="hero">
            <div class="hero-banner">
                <img src="{{ asset('images/Zodiac/banner.jpg') }}" alt="Astrology banner">
            </div>
            <div class="hero-overlay"></div>
            <div class="hero-copy">
                <div class="hero-copy-inner">
                    <span class="eyebrow"><i class="fas fa-moon"></i> Astrology</span>
                    <h1>{{ $currentSignName }}</h1>
                    <p>Discover your own personalized sign, element, birthstone and compatibility profile here.</p>
                    <div class="summary-row">
                        <div class="summary-chip">
                            <span>Sign</span>
                            <strong>{{ $currentSignName }}</strong>
                        </div>
                        <div class="summary-chip">
                            <span>Element</span>
                            <strong>{{ $currentSignCard['element'] ?? 'Not set' }}</strong>
                        </div>
                        <div class="summary-chip">
                            <span>Birthstone</span>
                            <strong>{{ $birthstoneProductName }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel section-card story-split">
            <div class="section-media sign-media">
                <img src="{{ $currentSignCard['image'] ?? asset('images/Zodiac/banner.jpg') }}" alt="{{ $currentSignName }}">
            </div>
            <div class="section-content">
                                <div class="meta-tags">
                    <span class="tag"><i class="fas fa-star"></i> {{ $currentSignName }}</span>
                   
                </div>
                <div class="section-head">
                    <h2>Your core sign profile</h2>
                    
                </div>
                <p>{{ $currentSignCard['description'] ?? 'Your zodiac sign description appears here.' }}</p>

            </div>
        </section>

        <section class="panel section-card">
            <div class="section-head">
                <h2>What Element Shapes the Energy of Your Sign?</h2>

            </div>
            <div class="section-media banner-media">
                <img class="banner-image" src="{{ $currentSignCard['element_banner'] ?? asset('images/Zodiac/elements.jpg') }}" alt="Element banner">
                <div class="banner-overlay"></div>
                <div class="banner-symbol">
                    <img src="{{ $currentSignCard['element_image'] ?? asset('images/Zodiac/elements.jpg') }}" alt="{{ $currentSignCard['element'] ?? 'Element' }}">
                </div>
            </div>
            <div class="section-content">
                <p>{{ $currentSignCard['element_description'] ?? 'Element details are available here.' }}</p>
                <div class="meta-tags">
                    <span class="tag"><i class="fas fa-fire"></i> {{ $currentSignCard['element'] ?? 'Element' }}</span>
                    <span class="tag"><i class="fas fa-star"></i> {{ $currentSignName }}</span>
                </div>
            </div>
        </section>

        <section class="panel section-card story-split">
            <div class="section-media sign-media month-accent">
                <img src="{{ $birthstoneCard['image'] ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $birthstoneProductName }}">
            </div>
            <div class="section-content">
                                <div class="meta-tags">
                    <span class="tag"><i class="fas fa-calendar"></i> {{ $birthstoneMonthName }}</span>
                 
                </div>
                <div class="section-head">
                    <h2>Your Birthstone</h2>
                   
                </div>

                <p>{{ $birthstoneCard['description'] ?? 'Your birthstone appears here based on your birth month.' }}</p>

            </div>
        </section>

        <section class="panel choice-panel">
            <div class="choice-layout">
                <div class="choice-banner">
                    <img src="{{ $currentSignCard['compatible_banner'] ?? asset('images/Zodiac/compatible.jpg') }}" alt="Compatibility banner">
                </div>

                <div class="choice-copy">
                    <div class="section-head">
                        <h2>Compatible Sign</h2>
                   
                    </div>
                    <div class="choice-row">
                        <label for="zodiacSelect">Choose sign</label>
                        <select id="zodiacSelect">
                            @foreach ($signOptions as $option)
                                <option value="{{ $option['zodiac_id'] }}" @selected($option['zodiac_id'] === $currentSignId)>
                                    {{ $option['sign_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="choice-result">
                        <span>Compatible sign</span>
                        <strong id="compatibilityText">{{ $currentSignCard['compatible_sign'] ?? 'Not available' }}</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel product-section">
            <div class="section-head">
                <div>
                    <h2>Recommended Products</h2>
                 
                </div>
                <div class="meta-tags">
                    <span class="tag" id="recommendedCount"><i class="fas fa-box"></i> {{ count($currentRecommendedProducts) }} products</span>
                </div>
            </div>
            <div class="product-grid" id="recommendedProducts">
                @foreach ($currentRecommendedProducts as $product)
                    <a class="product-card" href="{{ $product['url'] }}">
                        <span class="product-stock {{ strtolower(str_replace(' ', '-', $product['stock_status'] ?? 'in-stock')) }}">{{ $product['stock_label'] ?? 'In Stock' }}</span>
                        <div class="product-media">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                        </div>
                        <div class="product-body">
                            <div class="product-meta">{{ $product['meta'] ?? $recommendedProductLabel }}</div>
                            <h3>{{ $product['name'] }}</h3>
                            <p>{{ $product['description'] ?? 'Recommended for your birthstone.' }}</p>
                            <div class="product-price">Rs {{ number_format((float) ($product['price'] ?? 0), 2) }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="empty" id="recommendedEmpty" style="display:none;">No products are linked to this birthstone yet.</div>
        </section>
    </main>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const signOptions = @json($signOptions);
            const currentSignId = @json($currentSignId);
            const zodiacSelect = document.getElementById('zodiacSelect');
            const compatibilityText = document.getElementById('compatibilityText');
            const recommendedGrid = document.getElementById('recommendedProducts');
            const recommendedEmpty = document.getElementById('recommendedEmpty');
            const recommendedCount = document.getElementById('recommendedCount');
            const initialRecommendedProducts = @json($currentRecommendedProducts);
            const recommendedProductLabel = @json($recommendedProductLabel ?? 'Birthstone');

            function renderSelectedSign(signId) {
                const sign = signOptions.find((item) => String(item.zodiac_id) === String(signId)) || signOptions[0];

                if (!sign) {
                    compatibilityText.textContent = 'Not available';
                    return;
                }

                compatibilityText.textContent = sign.compatible_sign || 'Not available';
            }

            function escapeHtml(value) {
                return String(value ?? '')
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#39;');
            }

            zodiacSelect.addEventListener('change', (event) => {
                renderSelectedSign(event.target.value);
            });

            zodiacSelect.value = String(currentSignId || zodiacSelect.value || '');
            renderSelectedSign(zodiacSelect.value);
            renderRecommendedProducts(initialRecommendedProducts);

            function renderRecommendedProducts(products) {
                const list = Array.isArray(products) ? products : [];
                recommendedCount.textContent = `${list.length} product${list.length === 1 ? '' : 's'}`;
                recommendedEmpty.style.display = list.length ? 'none' : 'block';

                if (!list.length) {
                    recommendedGrid.innerHTML = '';
                    return;
                }

                recommendedGrid.innerHTML = list.map((product) => `
                    <a class="product-card" href="${product.url}">
                        <span class="product-stock ${String(product.stock_status || 'in-stock').replace(/_/g, '-')}">${escapeHtml(product.stock_label || 'In Stock')}</span>
                        <div class="product-media">
                            <img src="${product.image}" alt="${escapeHtml(product.name)}">
                        </div>
                        <div class="product-body">
                            <div class="product-meta">${escapeHtml(product.meta || recommendedProductLabel)}</div>
                            <h3>${escapeHtml(product.name)}</h3>
                            <p>${escapeHtml(product.description || 'Recommended for your birthstone.')}</p>
                            <div class="product-price">Rs ${Number(product.price || 0).toLocaleString('en-LK')}</div>
                        </div>
                    </a>
                `).join('');
            }
        });
    </script>
</body>
</html>
