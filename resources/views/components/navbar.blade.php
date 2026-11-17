<header class="site-navbar">
    @php
        $shopJewelleryTypes = \App\Models\JewelleryType::query()
            ->orderBy('name')
            ->get()
            ->reject(function ($type) {
                $name = \Illuminate\Support\Str::lower(trim((string) ($type->name ?? '')));

                return in_array($name, ['collections', 'other jewellery', 'other jewelry'], true);
            })
            ->map(fn ($type) => [
                'name' => $type->name,
                'slug' => \Illuminate\Support\Str::slug($type->name),
                'value' => 'type:' . \Illuminate\Support\Str::slug($type->name),
            ]);

        $shopJewellerySpecialLinks = collect([
            [
                'name' => 'Collections',
                'value' => 'collection:all',
                'url' => route('jewellery', ['category' => 'collection:all']),
            ],
            [
                'name' => 'Other Jewellery',
                'value' => 'type:other-jewellery',
                'url' => route('jewellery', ['category' => 'type:other-jewellery']),
            ],
        ]);

        $shopGemTypes = \App\Models\GemType::query()
            ->whereHas('gems.product')
            ->orderBy('name')
            ->get()
            ->map(fn ($type) => [
                'name' => $type->name,
                'slug' => \Illuminate\Support\Str::slug($type->name),
            ]);
    @endphp

    <a href="{{ route('home') }}" class="site-navbar-logo">
        <img src="{{ asset('images/web_logo.png') }}" alt="Gems & Jewelry Logo">
    </a>

    <div class="site-navbar-shell">
        <button type="button" class="site-navbar-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="site-navbar-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>

            <li class="site-navbar-shop">
                <a href="{{ route('jewellery') }}" class="{{ request()->routeIs('jewellery') || request()->routeIs('gems') ? 'active' : '' }}">Shop <i class="fas fa-caret-down"></i></a>
                <div class="site-navbar-dropdown site-navbar-shop-dropdown">
                    <div class="site-navbar-column">
                        <h4><a href="{{ route('jewellery') }}">Jewellery</a></h4>
                        <a class="site-navbar-link" href="{{ route('jewellery') }}">All Jewellery</a>
                        @foreach ($shopJewelleryTypes as $type)
                            <a class="site-navbar-link" href="{{ route('jewellery', ['category' => $type['value'] ?? ('type:' . ($type['slug'] ?? ''))]) }}">{{ $type['name'] }}</a>
                        @endforeach
                        @foreach ($shopJewellerySpecialLinks as $link)
                            <a class="site-navbar-link" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                        @endforeach
                    </div>

                    <div class="site-navbar-column">
                        <h4><a href="{{ route('gems') }}">Gems</a></h4>
                        <a class="site-navbar-link" href="{{ route('gems') }}">All Gems</a>
                        @foreach ($shopGemTypes as $type)
                            <a class="site-navbar-link" href="{{ route('gems', ['category' => $type['slug']]) }}">{{ $type['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            <li><a href="{{ route('blogs') }}" class="{{ request()->routeIs('blogs') ? 'active' : '' }}">Blog & News</a></li>
            <li><a href="{{ route('story') }}" class="{{ request()->routeIs('story') || request()->routeIs('gemstory') || request()->routeIs('juwelerystory') || request()->routeIs('jewelerystory') ? 'active' : '' }}">Shine & Story</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>

            @auth
                <li class="site-navbar-profile">
                    <button type="button" class="site-navbar-profile-btn" id="profileMenuToggle" aria-label="Open profile menu" aria-expanded="false" aria-haspopup="true">
                        @if (auth()->user()->profileImageUrl())
                            <img src="{{ auth()->user()->profileImageUrl() }}" alt="{{ auth()->user()->first_name }} profile image" class="site-navbar-avatar-image">
                        @else
                            <span class="site-navbar-avatar-text">{{ auth()->user()->profileInitial() }}</span>
                        @endif
                        <span class="site-navbar-profile-name">{{ auth()->user()->first_name }}</span>
                        <i class="fas fa-chevron-down site-navbar-caret"></i>
                    </button>
                    <div class="site-navbar-profile-menu" id="profileMenu">
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="site-navbar-profile-link"><i class="fas fa-chart-line"></i><span>Dashboard</span></a>
                        @elseif (auth()->user()->role === 'consultant')
                            <a href="{{ route('consultant.dashboard') }}" class="site-navbar-profile-link"><i class="fas fa-briefcase"></i><span>Dashboard</span></a>
                        @else
                            <a href="{{ route('profile') }}" class="site-navbar-profile-link"><i class="fas fa-user"></i><span>My Profile</span></a>
                            <a href="{{ route('orders') }}" class="site-navbar-profile-link"><i class="fas fa-box-open"></i><span>My Orders</span></a>
                            <a href="{{ route('wishlist') }}" class="site-navbar-profile-link"><i class="fas fa-heart"></i><span>Wishlist</span></a>
                            <a href="{{ route('cart') }}" class="site-navbar-profile-link"><i class="fas fa-cart-shopping"></i><span>Shopping Cart</span></a>
                            <a href="{{ route('checkout') }}" class="site-navbar-profile-link"><i class="fas fa-credit-card"></i><span>Checkout</span></a>
                            <a href="{{ route('custom.jewellery') }}" class="site-navbar-profile-link"><i class="fas fa-gem"></i><span>Custom Jewellery</span></a>
                            <a href="{{ route('consultations') }}" class="site-navbar-profile-link"><i class="fas fa-comments"></i><span>Consultations</span></a>
                            <a href="{{ route('contact.messages') }}" class="site-navbar-profile-link"><i class="fas fa-envelope-open-text"></i><span>Contact Messages</span></a>
                            <a href="{{ route('notifications') }}" class="site-navbar-profile-link"><i class="fas fa-bell"></i><span>Notifications</span></a>
                            <a href="{{ route('settings') }}" class="site-navbar-profile-link"><i class="fas fa-gear"></i><span>Settings</span></a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="site-navbar-profile-form">
                            @csrf
                            <button type="submit" class="site-navbar-profile-link logout"><i class="fas fa-right-from-bracket"></i><span>Logout</span></button>
                        </form>
                    </div>
                </li>
            @else
                <li><a href="{{ route('signin') }}" class="site-navbar-signin">Sign In</a></li>
            @endauth
        </ul>
    </div>
</header>

<style>
    :root {
        --site-font-sans: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html,
    body,
    button,
    input,
    select,
    textarea {
        font-family: var(--site-font-sans) !important;
    }

    html,
    body {
        margin: 0 !important;
    }

    html {
        scroll-padding-top: 120px;
    }

    body {
        padding-top: var(--site-navbar-offset, 120px) !important;
    }

    body.hero-page {
        padding-top: 0 !important;
    }

    body.home-page {
        padding-top: calc(var(--site-navbar-offset, 120px) - 20px) !important;
    }

    body.story-page,
    body.gem-story-page {
        padding-top: 0 !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: var(--site-font-sans) !important;
    }

    .site-navbar {
        background: rgba(255,255,255,.96);
        padding: 14px 34px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 8px 24px rgba(32,24,14,.08);
        backdrop-filter: blur(12px);
        width: 100%;
        box-sizing: border-box;
        margin-top: 0;
        margin-bottom: 0;
    }

    .site-navbar-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        flex-shrink: 0;
        max-width: 220px;
    }

    .site-navbar-logo img {
        height: 62px;
        max-height: 62px;
        max-width: 100%;
        width: auto;
        display: block;
        object-fit: contain;
    }

    .site-navbar-shell {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex: 1;
        min-width: 0;
    }

    .site-navbar-menu {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        padding: 0;
        min-width: 0;
    }

    .site-navbar-menu li {
        position: relative;
        flex-shrink: 0;
    }

    .site-navbar-menu li > a {
        display: block;
        padding: 10px 10px;
        color: #45382b;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: 0.3s;
    }

    .site-navbar-menu li > a.active,
    .site-navbar-menu li > a:hover {
        color: #bfa16a;
    }

    .site-navbar-signin {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-shrink: 0;
        line-height: 1;
        min-width: 110px;
        height: 40px;
        padding: 0 16px;
        border-radius: 999px;
        background: linear-gradient(135deg, #d3b270, #c49b52);
        color: #fff !important;
        font-size: 0.9rem;
        font-weight: 700;
        white-space: nowrap;
        vertical-align: middle;
        box-sizing: border-box;
        box-shadow: 0 8px 18px rgba(185, 146, 80, 0.14);
    }

    .site-navbar-signin:hover {
        color: #fff !important;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(185, 146, 80, 0.18);
    }

    .site-navbar-toggle {
        display: none;
        border: 0;
        background: transparent;
        font-size: 1.3rem;
        color: #3a342d;
        cursor: pointer;
        padding: 8px 10px;
    }

    .site-navbar-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        display: none;
        background: #fff;
        border: 1px solid #eadfcf;
        border-radius: 16px;
        box-shadow: 0 18px 34px rgba(0, 0, 0, 0.12);
        z-index: 1100;
    }

    .site-navbar-shop-dropdown {
        width: min(760px, 92vw);
        padding: 18px 20px 16px;
        gap: 18px;
        border-radius: 24px;
        border: 1px solid #eadfcf;
        left: 50%;
        transform: translateX(-50%);
    }

    .site-navbar-shop .site-navbar-shop-dropdown {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity .22s ease, visibility .22s ease, transform .22s ease;
        transform: translateX(-50%) translateY(8px);
    }

    .site-navbar-shop.site-navbar-shop-open .site-navbar-shop-dropdown {
        display: flex;
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateX(-50%) translateY(0);
    }

    .site-navbar-column {
        flex: 1;
        min-width: 220px;
    }

    .site-navbar-column h4 {
        margin: 0 0 10px;
        padding-bottom: 4px;
        color: #4a3a28;
        font-size: 0.98rem;
    }

    .site-navbar-column h4::after {
        content: "";
        display: block;
        width: 40px;
        height: 3px;
        margin-top: 6px;
        background: #bfa16a;
        border-radius: 2px;
    }

    .site-navbar-column h4 a {
        color: inherit;
        text-decoration: none;
    }

    .site-navbar-link {
        display: block;
        background: #faf7f2;
        border: 1px solid #f0e7d7;
        border-radius: 999px;
        padding: 4px 12px;
        margin-bottom: 3px;
        font-weight: 500;
        transition: 0.2s ease;
        color: #4d3a23;
        text-decoration: none;
    }

    .site-navbar-link:hover {
        background: #f5ebda;
        color: #bfa16a;
        border-color: #ead7bd;
    }

    .site-navbar-profile {
        display: flex;
        align-items: center;
        position: relative;
    }

    .site-navbar-profile-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 44px;
        padding: 4px 18px 4px 4px;
        border: 0;
        border-radius: 999px;
        background: linear-gradient(135deg, #c9a96a, #b89250);
        outline: none;
        cursor: pointer;
        box-shadow: 0 12px 24px rgba(185, 146, 80, 0.2);
    }

    .site-navbar-avatar-text {
        width: 36px;
        height: 36px;
        display: inline-grid;
        place-items: center;
        border-radius: 50%;
        background: rgba(255,255,255,.22);
        color: #fff;
        font-size: 0.92rem;
        font-weight: 800;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.18);
    }

    .site-navbar-avatar-image {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        border: 2px solid rgba(255,255,255,.28);
    }

    .site-navbar-profile-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1;
    }

    .site-navbar-caret {
        color: rgba(255,255,255,0.9);
        font-size: 0.78rem;
    }

    .site-navbar-profile-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        min-width: 230px;
        background: #fffdf9;
        border: 1px solid #eadfcf;
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(32,24,14,.14);
        padding: 10px;
        display: none;
        z-index: 1200;
        overflow: hidden;
    }

    .site-navbar-profile.open .site-navbar-profile-menu {
        display: block;
    }

    .site-navbar-profile-link {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        border: none;
        background: transparent;
        color: #3a342d;
        text-decoration: none;
        text-align: left;
        padding: 11px 12px;
        border-radius: 12px;
        font-size: 0.92rem;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .site-navbar-profile-link i {
        width: 16px;
        color: #b89250;
    }

    .site-navbar-profile-link:hover {
        background: #f4ecdf;
        color: #2f2923;
    }

    .site-navbar-profile-form {
        margin: 0;
    }

    .site-navbar-profile-link.logout {
        color: #8f2e2e;
    }

    .site-navbar-profile-link.logout i {
        color: #b64545;
    }

    @media (max-width: 900px) {
        .site-navbar {
            padding: 12px 16px;
            flex-wrap: wrap;
        }

        .site-navbar-logo {
            max-width: 190px;
        }

        .site-navbar-logo img {
            height: 56px;
            max-height: 56px;
        }

        .site-navbar-toggle {
            display: block;
        }

        .site-navbar-shell {
            width: 100%;
            display: block;
        }

        .site-navbar-menu {
            display: none;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #eee0c9;
        }

        .site-navbar-menu.open {
            display: flex;
        }

        .site-navbar-menu li {
            width: 100%;
        }

        .site-navbar-menu li > a,
        .site-navbar-signin {
            width: 100%;
            min-width: 0;
            height: 42px;
            padding-left: 14px;
            padding-right: 14px;
            font-size: 0.95rem;
            box-sizing: border-box;
        }

        .site-navbar-dropdown {
            position: static;
            width: 100%;
            box-shadow: none;
            border-radius: 12px;
            margin-top: 8px;
        }

        .site-navbar-shop.site-navbar-shop-open .site-navbar-shop-dropdown {
            display: block;
        }

        .site-navbar-shop-dropdown {
            width: 100%;
            max-height: none;
            padding: 12px;
            flex-direction: column;
            transform: none;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .site-navbar-profile-name,
        .site-navbar-caret {
            display: none;
        }

        .site-navbar-profile-btn {
            padding-right: 4px;
        }
    }

    #scrollTopBtn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        background: #c9a96a;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        z-index: 999;
    }

    #scrollTopBtn:hover {
        transform: translateY(-5px);
        background: #b89250;
    }
</style>

<script>
    (function () {
        const NAVBAR_GAP = 0;

        const syncBodyOffset = () => {
            const navbar = document.querySelector('.site-navbar');
            if (!navbar) {
                return;
            }

            const offset = navbar.offsetHeight + NAVBAR_GAP;
            document.documentElement.style.setProperty('--site-navbar-offset', `${offset}px`);
        };

        const menuToggle = document.querySelector('.site-navbar-toggle');
        const navList = document.querySelector('.site-navbar-menu');
        const shopNavItem = document.querySelector('.site-navbar-shop');
        const shopToggle = document.querySelector('.site-navbar-shop > a');
        const shopDropdown = document.querySelector('.site-navbar-shop .site-navbar-dropdown');
        let scrollTopBtn = document.getElementById('scrollTopBtn');

        if (menuToggle && navList) {
            menuToggle.addEventListener('click', () => {
                navList.classList.toggle('open');
            });
        }

        if (shopNavItem && shopToggle) {
            shopToggle.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();
                shopNavItem.classList.toggle('site-navbar-shop-open');
            });

            document.addEventListener('click', (event) => {
                if (!shopNavItem.contains(event.target)) {
                    shopNavItem.classList.remove('site-navbar-shop-open');
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    shopNavItem.classList.remove('site-navbar-shop-open');
                }
            });
        }

        if (!scrollTopBtn) {
            scrollTopBtn = document.createElement('button');
            scrollTopBtn.id = 'scrollTopBtn';
            scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            document.body.appendChild(scrollTopBtn);
        }

        const toggleScrollBtn = () => {
            if (window.pageYOffset > 200) {
                scrollTopBtn.style.display = 'flex';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        };

        window.addEventListener('scroll', toggleScrollBtn);
        window.addEventListener('resize', syncBodyOffset);
        window.addEventListener('load', syncBodyOffset);
        document.addEventListener('DOMContentLoaded', syncBodyOffset);
        toggleScrollBtn();

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const profileItem = document.querySelector('.site-navbar-profile');
        const profileToggle = document.getElementById('profileMenuToggle');
        const profileMenu = document.getElementById('profileMenu');

        if (profileItem && profileToggle && profileMenu) {
            profileToggle.addEventListener('click', (event) => {
                event.preventDefault();
                const willOpen = !profileItem.classList.contains('open');
                profileItem.classList.toggle('open', willOpen);
                profileToggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            });

            document.addEventListener('click', (event) => {
                if (!profileItem.contains(event.target)) {
                    profileItem.classList.remove('open');
                    profileToggle.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    profileItem.classList.remove('open');
                    profileToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    })();
</script>

<x-story-chatbot />
