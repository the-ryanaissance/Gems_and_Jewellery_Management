<style>
    .footer {
        background: #ddd6c8;
        color: #2f2a25;
        padding: 58px 0 0;
        margin-top: 0;
    }

    .footer-container {
        width: min(1200px, 92%);
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr;
        gap: 34px;
        align-items: start;
    }

    .footer-logo {
        width: 130px;
        height: auto;
        margin-bottom: 14px;
        filter: brightness(1.05);
    }

    .footer-about p,
    .footer-col p {
        color: #5f574d;
        font-size: 0.93rem;
        line-height: 1.7;
    }

    .footer-col h4 {
        color: #2f2a25;
        font-size: 0.95rem;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .footer-col ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-col ul li {
        margin-bottom: 8px;
    }

    .footer-col ul li a {
        color: #5a5248;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s ease;
    }

    .footer-col ul li a:hover {
        color: #1f1b16;
    }

    .footer-about .footer-socials {
        display: flex;
        gap: 10px;
        margin-top: 18px;
    }

    .footer-about .footer-socials a {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid #4f5866;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #d3d9e3;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .footer-about .footer-socials a:hover {
        border-color: #bfa16a;
        color: #bfa16a;
        transform: translateY(-1px);
    }

    .footer-divider {
        width: min(1200px, 92%);
        margin: 28px auto 0;
        border-top: 1px solid #bfb6a7;
    }

    .footer-socials-center {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 22px;
    }

    .footer-socials-center a {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid #9e9483;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #4a4339;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .footer-socials-center a:hover {
        border-color: #bfa16a;
        color: #bfa16a;
        transform: translateY(-1px);
    }

    .footer-bottom {
        margin-top: 12px;
        text-align: center;
        padding: 16px 12px 22px;
    }

    .footer-bottom p {
        margin: 0;
        color: #5f574d;
        font-size: 0.88rem;
    }

    .footer-bottom .brand-highlight {
        color: #2f2a25;
        font-weight: 700;
    }

    .footer-login-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(18, 14, 8, 0.58);
        backdrop-filter: blur(4px);
        z-index: 3000;
        padding: 20px;
    }

    .footer-login-modal.open {
        display: flex;
    }

    .footer-login-modal-card {
        width: min(100%, 440px);
        background: #fff;
        border-radius: 18px;
        border: 1px solid #eadcc0;
        box-shadow: 0 24px 60px rgba(0,0,0,.22);
        padding: 24px 22px 20px;
        display: block;
    }

    .footer-login-modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .footer-login-modal-head h3 {
        font-size: 1.35rem;
        color: #1c1c1c;
        font-family: Georgia, "Times New Roman", serif;
        margin: 0;
        line-height: 1.1;
    }

    .footer-login-modal-close {
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
        font-size: 1rem;
    }

    .footer-login-modal p {
        color: #5e5e5e;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 18px;
        margin-top: 0;
    }

    .footer-login-modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    .footer-login-modal-actions .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1 1 150px;
        min-width: 150px;
        max-width: 180px;
        height: 48px;
        padding: 0 18px;
        font-size: 0.98rem;
        font-weight: 800;
        border-radius: 8px;
        box-sizing: border-box;
        text-decoration: none;
    }

    .footer-login-modal-actions .btn.secondary {
        background: #efe3c8;
        color: #634f2c;
        box-shadow: none;
    }

    .footer-login-modal-actions .btn.primary {
        background: linear-gradient(135deg, #c9a96a, #b89250);
        color: #fff;
    }

    .footer-login-modal-actions .btn:hover {
        transform: translateY(-1px);
    }

    @media (max-width: 980px) {
        .footer-container {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }
    }

    @media (max-width: 640px) {
        .footer {
            padding-top: 42px;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

@php
    $footerJewelleryTypes = \App\Models\JewelleryType::query()
        ->orderBy('name')
        ->get()
        ->map(fn ($type) => [
            'name' => $type->name,
            'value' => 'type:'.\Illuminate\Support\Str::slug($type->name),
        ]);

    $footerGemTypes = \App\Models\GemType::query()
        ->whereHas('gems.product')
        ->orderBy('name')
        ->get()
        ->map(fn ($type) => [
            'name' => $type->name,
            'slug' => \Illuminate\Support\Str::slug($type->name),
        ]);
@endphp

<footer class="footer">
    <div class="footer-container">

        
        <div class="footer-col footer-about">
            <img src="{{ asset('images/web_logo.png') }}" alt="Website Logo" class="footer-logo">

            <p>
                Discover premium handcrafted jewellery designed with elegance and
                perfection. We bring timeless beauty and luxury to every special
                moment of your life.
            </p>

        </div>

        
        <div class="footer-col">
            <h4>Categories</h4>
            <ul>
                <li><b><a href="{{ route('jewellery') }}">All Jewellery</a></b></li>

                <li><b><a href="{{ route('gems') }}">All Gems</a></b></li>

            </ul>
        </div>

        
        <div class="footer-col">
            <h4>Information</h4>
            <ul>
                <li><a href="{{ route('blogs') }}">Blog & News</a></li>
                <li><a href="{{ route('story') }}">Shine & Story</a></li>
                @auth
                    <li><a href="{{ route('orders') }}">Order Tracking</a></li>
                @else
                    <li><a href="{{ route('signin') }}" class="js-footer-login-gate" data-login-url="{{ route('signin') }}">Order Tracking</a></li>
                @endauth
                <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                @auth
                    <li><a href="{{ route('cart') }}">Shopping Cart</a></li>
                @else
                    <li><a href="{{ route('signin') }}" class="js-footer-login-gate" data-login-url="{{ route('signin') }}">Shopping Cart</a></li>
                @endauth
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('faq') }}">FAQ</a></li>
            </ul>
        </div>

        
        <div class="footer-col">
            <h4>Need Help?</h4>
            <p>Head Office: JGGR+267, Pelmadulla, Rathnapura, Sri Lanka</p>
            <p>Tel: 071 281 8341</p>
            <p>Email: pinwnthagems@gmail.com</p>
        </div>

    </div>

    <div class="footer-divider"></div>

    <div class="footer-socials-center">
        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
        <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
    </div>

    
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} <span class="brand-highlight">Pinwntha Gems &amp; Jewellery</span>. All rights reserved. | Terms &amp; Privacy apply.</p>
    </div>
</footer>

<div id="footerLoginModal" class="footer-login-modal" aria-hidden="true">
    <div class="footer-login-modal-card" role="dialog" aria-modal="true" aria-labelledby="footerLoginModalTitle">
        <div class="footer-login-modal-head">
            <h3 id="footerLoginModalTitle">Please log in first</h3>
            <button class="footer-login-modal-close" type="button" aria-label="Close dialog" data-footer-login-modal-close>
                <i class="fas fa-xmark"></i>
            </button>
        </div>
        <p>You can browse the footer links, but to continue to order tracking or your shopping cart, please sign in first.</p>
        <div class="footer-login-modal-actions">
            <button class="btn secondary" type="button" data-footer-login-modal-close>Cancel</button>
            <a class="btn primary" href="{{ route('signin') }}" id="footerLoginModalLink">Sign In</a>
        </div>
    </div>
</div>

<script>
(function () {
    const modal = document.getElementById('footerLoginModal');
    const modalLink = document.getElementById('footerLoginModalLink');

    if (!modal || !modalLink) return;

    function openFooterLoginModal(loginUrl) {
        modalLink.href = loginUrl || "{{ route('signin') }}";
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeFooterLoginModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
    }

    document.querySelectorAll('[data-footer-login-modal-close]').forEach((button) => {
        button.addEventListener('click', closeFooterLoginModal);
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeFooterLoginModal();
        }
    });

    document.querySelectorAll('.js-footer-login-gate').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            openFooterLoginModal(link.dataset.loginUrl || "{{ route('signin') }}");
        });
    });
})();
</script>
