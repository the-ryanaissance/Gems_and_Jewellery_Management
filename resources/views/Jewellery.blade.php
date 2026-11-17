<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jewellery Categories</title>
<link rel="icon" type="image/png" href="{{ asset('images/main_website/web_logo.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #222; background: #fff; overflow-x: hidden; }
input, select, textarea, button { font-family: inherit; }
nav { background: #fff; padding: 10px 30px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,.1); position: sticky; top: 0; z-index: 100; }
.logo { display: flex; align-items: center; text-decoration: none; }
.logo img { height: 80px; width: auto; display: block; }
nav ul { list-style: none; display: flex; align-items: center; margin: 0; padding: 0; }
nav ul li { margin-right: 20px; position: relative; }
nav ul li a { display: block; padding: 10px 12px; color: #333; text-decoration: none; font-weight: 500; }
nav ul li a:hover { color: #bfa16a; }
.about-header {
    position: relative;
    width: 100%;
    height: 380px;
    background: url("{{ asset('images/main_website/about_header.jpg') }}") center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    overflow: hidden;
}
.about-header .overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
}
.about-header .header-content {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease-out forwards;
    padding: 0 18px;
}
.about-header h1 {
    font-size: clamp(2rem, 3.8vw, 3rem);
    margin-bottom: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.about-header p {
    max-width: 860px;
    margin: 0 auto;
    line-height: 1.8;
    color: #f3f3f3;
    font-size: 1.3rem;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(26px); }
    to { opacity: 1; transform: translateY(0); }
}
.wrap { max-width: 1180px; margin: 0 auto; padding: 34px 20px 70px; }
.cards { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 14px; }
.cat-card {
background: #f4f1ec;
border: 1px solid #e5d7bf;
border-radius: 18px;
padding: 18px 12px;
text-align: center;
cursor: pointer;
transition: .2s ease;
}
.cat-card:hover { transform: translateY(-4px); background: #fff; box-shadow: 0 8px 20px rgba(191, 161, 106, .25); }
.cat-card.active { border-color: #bfa16a; box-shadow: 0 8px 20px rgba(191, 161, 106, .25); background: #fff; }
.category-icon {
width: 56px;
height: 56px;
margin: 0 auto 12px;
border-radius: 50%;
background: #fff;
display: flex;
align-items: center;
justify-content: center;
box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.05);
transition: 0.3s;
}
.category-icon img {
width: 38px;
height: 38px;
object-fit: contain;
filter: brightness(0) saturate(100%) invert(74%) sepia(32%) saturate(600%) hue-rotate(10deg);
transition: .3s ease;
}
.cat-card h3 { font-size: .95rem; color: #2b2b2b; margin: 0; }
.cat-card:hover .category-icon,
.cat-card.active .category-icon { background: linear-gradient(135deg, #bfa16a, #e6c67a); }
.cat-card:hover .category-icon img,
.cat-card.active .category-icon img { filter: brightness(0) invert(1); }

.layout-grid {
    display: grid;
    grid-template-columns: minmax(240px, 280px) 1fr;
    gap: 20px;
    margin-top: 24px;
}
.filters-column {
    position: sticky;
    top: 110px;
    align-self: start;
    height: fit-content;
}

.category-filter {
margin-top: 0;
background: #fff;
border: 1px solid #efdfc1;
border-radius: 14px;
padding: 16px;
box-shadow: 0 12px 24px rgba(191,161,106,.18);
}
.category-filter h3 { margin: 0 0 10px; font-size: 1rem; color: #7f6334; }
.category-filter-row {
display: grid;
grid-template-columns: 1fr;
gap: 14px;
}
.category-filter-group input[type="text"] {
width: 100%;
border: 1px solid #ddd3c1;
border-radius: 10px;
padding: 10px 12px;
background: #fff;
color: #333;
font-size: .92rem;
}
.category-filter-group label {
display: block;
font-size: .76rem;
font-weight: 700;
color: #8b7a5a;
text-transform: uppercase;
letter-spacing: .5px;
margin-bottom: 5px;
}
.category-filter-group select {
width: 100%;
border: 1px solid #ddd3c1;
border-radius: 10px;
padding: 10px 12px;
background: #fff;
color: #333;
font-size: .92rem;
}
.category-filter-btn {
border: none;
border-radius: 10px;
padding: 10px 16px;
cursor: pointer;
font-weight: 700;
white-space: nowrap;
display: inline-flex;
align-items: center;
justify-content: center;
gap: 8px;
}
.category-filter-btn.apply { background: #bfa16a; color: #fff; }
.category-filter-btn.reset { background: #f3e5cb; color: #5d4722; }
.filter-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.filter-pill-wrap {
display: block;
}
.filter-box {
background: #fffaf1;
border: 1px solid #eadbc9;
border-radius: 12px;
padding: 10px 12px;
display: grid;
gap: 4px;
margin-bottom: 12px;
}
.filter-box.split-columns {
grid-template-columns: repeat(2, minmax(0, 1fr));
gap: 8px 12px;
align-items: start;
}
.filter-box.split-columns .filter-box-title {
grid-column: 1 / -1;
}
.filter-box-title {
font-size: .78rem;
font-weight: 700;
color: #7c6342;
text-transform: uppercase;
letter-spacing: .5px;
}
.filter-box label {
display: flex;
align-items: center;
gap: 6px;
font-size: .9rem;
color: #3f3f3f;
}
.category-filter-products {
margin-top: 0;
background: #fff;
border: 1px solid #efdfc1;
border-radius: 14px;
padding: 14px;
display: block;
box-shadow: 0 8px 20px rgba(191,161,106,.16);
}
.category-filter-products h4 {
margin: 0 0 10px;
font-size: .98rem;
color: #7f6334;
}
.filter-preview-grid {
margin-top: 12px;
display: grid;
grid-template-columns: repeat(3, minmax(0, 1fr));
gap: 12px;
}
.filter-preview-card {
border: 1px solid #e8d6b7;
border-radius: 12px;
background: #fff;
overflow: hidden;
cursor: pointer;
transition: .2s ease;
display: block;
text-decoration: none;
color: inherit;
}
.filter-preview-card:hover {
transform: translateY(-3px);
border-color: #c9a669;
box-shadow: 0 8px 16px rgba(0, 0, 0, .06);
}
.filter-preview-media {
background: #fff;
padding: 8px;
}
.filter-preview-media img {
width: 100%;
height: 170px;
object-fit: cover;
border-radius: 10px;
display: block;
}
.filter-preview-body { padding: 12px; }
.product-stock {
display: inline-flex;
align-items: center;
padding: 2px 7px;
border-radius: 999px;
font-size: .59rem;
line-height: 1;
font-weight: 700;
letter-spacing: .28px;
text-transform: uppercase;
border: 1px solid transparent;
width: max-content;
margin-bottom: 5px;
opacity: .9;
}
.product-stock.in-stock { background: #edf7ee; color: #245f30; border-color: #c9e8ce; }
.product-stock.critical { background: #fff0e7; color: #b55a2d; border-color: #f1ccb5; }
.product-stock.out-of-stock { background: #f5e6e6; color: #a33; border-color: #edc8c8; }
.filter-preview-meta {
margin-bottom: 5px;
color: #8d8d8d;
font-size: .72rem;
text-transform: uppercase;
letter-spacing: .6px;
font-weight: 700;
}
.filter-preview-name {
margin: 0 0 6px;
color: #1f1f1f;
font-size: .96rem;
line-height: 1.35;
}
.filter-preview-desc {
margin: 0 0 8px;
font-size: .86rem;
color: #575757;
line-height: 1.5;
}
.filter-preview-price {
margin: 0;
color: #111;
font-size: 1rem;
font-weight: 800;
}
.filter-preview-empty {
margin-top: 18px;
color: #6c6c6c;
display: none;
text-align: center;
font-style: italic;
}
.cta {
border-radius: 14px;
background: #5a4a32;
color: #fff;
padding: 16px 14px;
display: flex;
justify-content: space-between;
gap: 12px;
align-items: center;
flex-wrap: wrap;
}
.cta a {
background: #bfa16a;
color: #fff;
text-decoration: none;
padding: 10px 16px;
border-radius: 10px;
font-weight: 700;
white-space: nowrap;
}
.login-modal {
    position: fixed;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 18px;
    background: rgba(22, 18, 12, .56);
    backdrop-filter: blur(5px);
    z-index: 1400;
}
.login-modal.open { display: flex; }
.login-modal-card {
    width: min(520px, 100%);
    border-radius: 24px;
    background: #fffdf9;
    border: 1px solid #eadbc6;
    box-shadow: 0 24px 64px rgba(32, 24, 14, .22);
    padding: 22px 22px 20px;
}
.login-modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 12px;
}
.login-modal-head h3 {
    margin: 0;
    font-size: 1.3rem;
    color: #2d241b;
}
.login-modal-close {
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: #f5ebda;
    color: #5a4531;
    cursor: pointer;
}
.login-modal-card p {
    margin: 0;
    color: #6f5b47;
    line-height: 1.6;
}
.login-modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 18px;
    flex-wrap: wrap;
}
.login-modal-actions .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    padding: 0 16px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
}
.login-modal-actions .btn.secondary {
    background: #fff;
    color: #2d241b;
    border: 1px solid #e8d6b7;
}
.login-modal-actions .btn.primary {
    background: linear-gradient(135deg, #c5a067, #9f7740);
    color: #fff;
}
@media (max-width: 1024px) {
    .layout-grid { grid-template-columns: 1fr; }
    .filters-column { position: static; }
    .cards { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}
@media (max-width: 900px) {
    .cards, .filter-preview-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 560px) {
    .cards, .filter-preview-grid, .filter-pill-wrap { grid-template-columns: 1fr; }
    .filter-actions { grid-template-columns: 1fr; }
}
</style>
</head>
<body class="hero-page">
<x-navbar />
<section class="about-header">
    <div class="overlay"></div>
    <div class="header-content">
        <h1>Jewellery</h1>
        <p>Explore Our Top Quality Luxury Jewellery.</p>
    </div>
</section>
<main class="wrap">
<section id="jewellery-main" class="cards">
@foreach ($categories as $category)
<article class="cat-card" data-value="{{ $category['value'] }}">
<div class="category-icon">
<img src="{{ $category['icon'] ?? asset('images/main_website/web_ji'.$category['id'].'.png') }}" alt="{{ $category['name'] }}">
</div>
<h3>{{ $category['name'] }}</h3>
</article>
@endforeach
</section>

<div class="layout-grid">
    <aside class="filters-column">
            <section class="category-filter">
                <h3>Find Your Perfect Piece</h3>
                <div class="category-filter-row">
                    <div class="category-filter-group">
                       
                        <input id="jKeyword" type="text" placeholder="Search name, description...">
                    </div>
                    <div class="category-filter-group">
                        <label for="jMainFilter">Category</label>
                        <select id="jMainFilter">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category['value'] }}">{{ $category['name'] }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="filter-pill-wrap">
                    <div class="filter-box {{ collect($filterOptions['price_range'] ?? [])->count() > 6 ? 'split-columns' : '' }}">
                        <span class="filter-box-title">Price Range</span>
                        <label><input type="checkbox" name="price_range" value="0-5000"> LKR 0 – 5,000</label>
                        <label><input type="checkbox" name="price_range" value="5000-10000"> LKR 5,000 – 10,000</label>
                        <label><input type="checkbox" name="price_range" value="10000-20000"> LKR 10,000 – 20,000</label>
                        <label><input type="checkbox" name="price_range" value="20000-999999"> LKR 20,000+</label>
                    </div>
                    <div class="filter-box {{ collect($filterOptions['occasion'] ?? [])->count() > 6 ? 'split-columns' : '' }}">
                        <span class="filter-box-title">Occasion</span>
                        @foreach ($filterOptions['occasion'] as $occasion)
                            <label><input type="checkbox" name="occasion" value="{{ $occasion }}">{{ $occasion }}</label>
                        @endforeach
                    </div>
                    <div class="filter-box {{ collect($filterOptions['metal'] ?? [])->count() > 6 ? 'split-columns' : '' }}">
                        <span class="filter-box-title">Metal</span>
                        @foreach ($filterOptions['metal'] as $metal)
                            <label><input type="checkbox" name="metal" value="{{ $metal }}">{{ $metal }}</label>
                        @endforeach
                    </div>
                    <div class="filter-box {{ collect($filterOptions['gemstone'] ?? [])->count() > 6 ? 'split-columns' : '' }}">
                        <span class="filter-box-title">Gemstone</span>
                        @foreach ($filterOptions['gemstone'] as $gemstone)
                            <label><input type="checkbox" name="gemstone" value="{{ $gemstone }}">{{ $gemstone }}</label>
                        @endforeach
                    </div>
                    <div class="filter-box {{ collect($filterOptions['gender'] ?? [])->count() > 6 ? 'split-columns' : '' }}">
                        <span class="filter-box-title">Gender</span>
                        @foreach ($filterOptions['gender'] as $gender)
                            <label><input type="checkbox" name="gender" value="{{ $gender }}">{{ $gender }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="filter-actions">
                    <button id="jFilterApply" class="category-filter-btn apply" type="button">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button id="jFilterReset" class="category-filter-btn reset" type="button">
                        <i class="fas fa-rotate-right"></i> Reset
                    </button>
                </div>
            </div>
        </section>
    </aside>

    <section class="category-filter-products">
        <div class="detail-head" style="margin-bottom:10px;">
            <h4 id="jFilterProductsTitle">All Products in Our Store</h4>
        </div>
        <div id="jFilterPreviewGrid" class="filter-preview-grid">
            @foreach ($initialProducts as $product)
                @php
                    $jewel    = $product->jewellery;
                    $collection = $product->collection;
                    $metaBits = collect([$jewel?->metal ?? $collection?->metal, $jewel?->occasion ?? $collection?->occasion, $jewel?->gemstone ?? $collection?->gemstone])
                        ->filter()
                        ->map(fn ($piece) => strtoupper($piece))
                        ->implode(' • ');
                    $imageUrl = $product->image
                        ? asset('images/Product/'.$product->image)
                        : asset('images/placeholders/jewel.jpg');
                @endphp
                <a class="filter-preview-card" href="{{ route('products.show', $product->product_id) }}" data-product-id="{{ $product->product_id }}">
                    <div class="filter-preview-media">
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                    </div>
                    <div class="filter-preview-body">
                        <span class="product-stock {{ (int) $product->stock <= 0 ? 'out-of-stock' : ((int) $product->stock <= 5 ? 'critical' : 'in-stock') }}">{{ (int) $product->stock <= 0 ? 'out of stock' : ((int) $product->stock <= 5 ? 'low stock' : 'in-stock') }}</span>
                        <p class="filter-preview-meta">{{ $metaBits }}</p>
                        <h4 class="filter-preview-name">{{ $product->name }}</h4>
                        <p class="filter-preview-desc">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                        <p class="filter-preview-price">LKR {{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <p id="jFilterPreviewEmpty" class="filter-preview-empty">No items found for this filter.</p>
        <div class="cta" style="margin-top:14px;">
            <p><strong>Didn't find what you're looking for?</strong> Design your own!</p>
            @guest
                <a href="{{ route('signin') }}" class="js-jewellery-login-gate" data-login-url="{{ route('signin') }}">Design</a>
            @else
                <a href="{{ route('custom.jewellery') }}#customRequestModal">Design</a>
            @endguest
        </div>
    </section>
</div>
</main>
<div id="jewelleryLoginModal" class="login-modal" aria-hidden="true">
    <div class="login-modal-card" role="dialog" aria-modal="true" aria-labelledby="jewelleryLoginModalTitle">
        <div class="login-modal-head">
            <h3 id="jewelleryLoginModalTitle">Please log in first</h3>
            <button class="login-modal-close" type="button" aria-label="Close dialog" data-jewellery-login-modal-close>
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p>You can browse jewellery without signing in. To continue, please sign in first.</p>
        <div class="login-modal-actions">
            <button class="btn secondary" type="button" data-jewellery-login-modal-close>Cancel</button>
            <a class="btn primary" href="{{ route('signin') }}" id="jewelleryLoginModalLink">Sign In</a>
        </div>
    </div>
</div>
<x-footer />
<script>
document.addEventListener('DOMContentLoaded', () => {
const jewelleryLoginModal = document.getElementById('jewelleryLoginModal');
const jewelleryLoginModalLink = document.getElementById('jewelleryLoginModalLink');
const gridEl           = document.getElementById('jFilterPreviewGrid');
const emptyEl          = document.getElementById('jFilterPreviewEmpty');
const titleEl          = document.getElementById('jFilterProductsTitle');
const categorySelect   = document.getElementById('jMainFilter');
const applyButton      = document.getElementById('jFilterApply');
const resetButton      = document.getElementById('jFilterReset');
const filterEndpoint   = '{{ route('jewellery.filter') }}';
const csrfToken        = document.querySelector('meta[name="csrf-token"]').content;
const imageFallback    = '{{ asset('images/placeholders/notavailable.png') }}';
const typeLabels       = @json($categories->pluck('name', 'value'));
const keywordInput     = document.getElementById('jKeyword');
const categoryCards    = Array.from(document.querySelectorAll('.cat-card[data-value]'));
const filterInputs     = Array.from(document.querySelectorAll('.category-filter input[type="checkbox"]'));
let keywordTimer       = null;
const initialCategory  = new URLSearchParams(window.location.search).get('category') || (window.location.hash ? `type:${window.location.hash.replace('#', '').trim()}` : '');
const priceRangeBox    = Array.from(document.querySelectorAll('.filter-box'))
    .find(box => box.querySelector('.filter-box-title')?.textContent.trim() === 'Price Range');

function openJewelleryLoginModal(loginUrl) {
    if (!jewelleryLoginModal || !jewelleryLoginModalLink) return;
    jewelleryLoginModalLink.href = loginUrl || "{{ route('signin') }}";
    jewelleryLoginModal.classList.add('open');
    jewelleryLoginModal.setAttribute('aria-hidden', 'false');
}

function closeJewelleryLoginModal() {
    if (!jewelleryLoginModal) return;
    jewelleryLoginModal.classList.remove('open');
    jewelleryLoginModal.setAttribute('aria-hidden', 'true');
}

document.querySelectorAll('[data-jewellery-login-modal-close]').forEach((button) => {
    button.addEventListener('click', closeJewelleryLoginModal);
});

jewelleryLoginModal?.addEventListener('click', (event) => {
    if (event.target === jewelleryLoginModal) {
        closeJewelleryLoginModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeJewelleryLoginModal();
    }
});

document.querySelectorAll('.js-jewellery-login-gate').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        openJewelleryLoginModal(button.dataset.loginUrl || "{{ route('signin') }}");
    });
});

if (priceRangeBox) {
    priceRangeBox.innerHTML = `
        <span class="filter-box-title">Price Range</span>
        <label><input type="checkbox" name="price_range" value="0-9999"> Less than 10,000</label>
        <label><input type="checkbox" name="price_range" value="10000-25000"> 10,000 - 25,000</label>
        <label><input type="checkbox" name="price_range" value="25000-50000"> 25,000 - 50,000</label>
        <label><input type="checkbox" name="price_range" value="50000-75000"> 50,000 - 75,000</label>
        <label><input type="checkbox" name="price_range" value="75000-100000"> 75,000 - 100,000</label>
        <label><input type="checkbox" name="price_range" value="100000-999999999"> 100,000+</label>
    `;

    priceRangeBox.querySelectorAll('input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', () => fetchProducts(collectFilters()));
    });
}

if (initialCategory && Array.from(categorySelect.options).some(option => option.value === initialCategory)) {
    categorySelect.value = initialCategory;
    updateTitle(initialCategory);
    syncActiveCard(initialCategory);
}

categoryCards.forEach(card => {
    card.addEventListener('click', () => {
        const value = card.dataset.value;
        categorySelect.value = value;
        updateTitle(value);
        syncActiveCard(value);
        fetchProducts(collectFilters());
    });
});

categorySelect.addEventListener('change', () => {
    updateTitle(categorySelect.value);
    syncActiveCard(categorySelect.value);
    fetchProducts(collectFilters());
});

filterInputs.forEach(input => {
    input.addEventListener('change', () => fetchProducts(collectFilters()));
});

keywordInput.addEventListener('input', () => {
    clearTimeout(keywordTimer);
    keywordTimer = setTimeout(() => fetchProducts(collectFilters()), 250);
});

keywordInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        fetchProducts(collectFilters());
    }
});

function updateTitle(value) {
    if (!value) {
        titleEl.textContent = 'All Products in Our Store';
        return;
    }

    const option = Array.from(categorySelect.options).find(opt => opt.value === value);
    const label = option?.textContent?.trim() || typeLabels[value];
    titleEl.textContent = label ? `${label} in Our Store` : 'All Products in Our Store';
}

function syncActiveCard(value) {
    categoryCards.forEach(card => {
        card.classList.toggle('active', card.dataset.value === value);
    });
}

function collectFilters() {
    const payload = new FormData();
    const catValue = categorySelect.value;
    if (catValue) payload.append('category[]', catValue);
    const keyword = keywordInput.value.trim();
    if (keyword) payload.append('keyword', keyword);

    document.querySelectorAll('input[name="price_range"]:checked')
        .forEach(cb => payload.append('price_range[]', cb.value));

    ['occasion', 'metal', 'gemstone', 'gender'].forEach(field => {
        document.querySelectorAll(`input[name="${field}"]:checked`)
            .forEach(cb => payload.append(`${field}[]`, cb.value));
    });

    return payload;
}

async function fetchProducts(formData = null) {
    try {
        const response = await fetch(filterEndpoint, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData ?? new FormData()
        });

        if (!response.ok) {
            console.error('Filter request failed:', await response.text());
            return;
        }

        const products = await response.json();
        renderProducts(products);
    } catch (error) {
        console.error('Unexpected error:', error);
    }
}

function renderProducts(products) {
        gridEl.innerHTML = '';
        if (!products.length) {
            emptyEl.style.display = 'block';
            return;
        }
    emptyEl.style.display = 'none';

    products.forEach(product => {
        const jewel = product.jewellery || {};
        const collection = product.collection || {};
        const metaParts = [jewel.metal || collection.metal, jewel.occasion || collection.occasion, jewel.gemstone || collection.gemstone]
            .filter(Boolean)
            .map(part => part.toUpperCase())
            .join(' • ');

        const description = (product.description || '').length
            ? `${product.description.slice(0, 90)}${product.description.length > 90 ? '…' : ''}`
            : '—';

        const imageUrl = product.image || imageFallback;

        gridEl.insertAdjacentHTML('beforeend', `
            <a class="filter-preview-card" href="${product.url}" data-product-id="${product.product_id}">
                <div class="filter-preview-media">
                    <img src="${imageUrl}" alt="${product.name}">
                </div>
                <div class="filter-preview-body">
                    <span class="product-stock ${String(product.stock_status || 'in-stock').replace(/_/g, '-')}">${product.stock_label || 'in-stock'}</span>
                    <p class="filter-preview-meta">${metaParts}</p>
                    <h4 class="filter-preview-name">${product.name}</h4>
                    <p class="filter-preview-desc">${description}</p>
                    <p class="filter-preview-price">LKR ${Number(product.price || 0).toLocaleString('en-LK', { minimumFractionDigits: 2 })}</p>
                </div>
            </a>
        `);
    });
}

applyButton.addEventListener('click', () => fetchProducts(collectFilters()));

resetButton.addEventListener('click', () => {
    categorySelect.value = '';
    keywordInput.value = '';
    document.querySelectorAll('.category-filter input[type="checkbox"]').forEach(cb => cb.checked = false);
    updateTitle('');
    syncActiveCard('');
    fetchProducts();
});

if (initialCategory) {
    fetchProducts(collectFilters());
}
});
</script>
</body>
</html>
