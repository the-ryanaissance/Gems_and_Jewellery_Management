<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Pinwntha Gems</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff8f0;
            overflow-x: hidden;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 80px;
            width: auto;
            display: block;
        }

        nav {
            background: #fff;
            padding: 10px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #bfa16a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-right: 20px;
            position: relative;
        }

        nav ul li a {
            display: block;
            padding: 10px 12px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        nav ul li a:hover {
            color: #bfa16a;
        }

        .signin-btn {
            background: #bfa16a;
            color: #fff;
            padding: 6px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .signin-btn:hover {
            background: #e6c67a;
            color: #000;
        }

        nav ul li .dropdown {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 100vw;
            background: #fff;
            padding: 40px 80px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            display: none;
            justify-content: space-between;
            box-sizing: border-box;
        }

        nav ul li:hover>.dropdown {
            display: flex;
        }

        .dropdown .column {
            flex: 1;
            min-width: 180px;
            margin-right: 40px;
        }

        .dropdown h4 {
            margin-top: 0;
            color: #bfa16a;
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-weight: 600;
            position: relative;
            padding-bottom: 5px;
        }

        .dropdown h4::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #bfa16a;
            border-radius: 2px;
        }

        .dropdown a {
            color: #333;
            text-decoration: none;
            display: block;
            margin: 2px 0;
            padding: 2px 0;
            transition: 0.2s;
            font-size: 0.95rem;
        }

        .dropdown a:hover {
            color: #bfa16a;
        }

        .about-header {
            position: relative;
            width: 100%;
            height: 400px;
            background: url('{{ asset('images/main_website/about_header.jpg') }}') center/cover no-repeat;
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
        }

        .about-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .about-header p {
            font-size: 1.2rem;
            margin: 0;
        }

        .privacy-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px 30px;
        }

        .privacy-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            padding: 30px;
            margin-bottom: 20px;
        }

        .privacy-card h2 {
            color: #bfa16a;
            margin: 0 0 12px;
            font-size: 1.4rem;
        }

        .privacy-card p {
            color: #444;
            line-height: 1.8;
            font-size: 0.98rem;
            margin: 0 0 12px;
        }

        .back-btn {
            position: fixed;
            top: 100px;
            left: 30px;
            z-index: 999;
            background: #bfa16a;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #e6c67a;
            color: #000;
            transform: translateY(-3px);
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            nav ul {
                flex-direction: column;
                display: none;
                background: #fff;
                width: 100%;
            }

            nav ul.show {
                display: flex;
            }

            nav ul li .dropdown {
                position: static;
                flex-direction: column;
                width: 100%;
                padding: 20px;
                box-shadow: none;
            }

            .dropdown .column {
                margin: 15px 0;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                font-size: 1.5rem;
                color: #333;
            }
        }

        @media (min-width: 1025px) {
            .menu-toggle {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .about-header {
                height: 300px;
                padding: 0 20px;
            }

            .about-header h1 {
                font-size: 2.2rem;
            }

            .about-header p {
                font-size: 1rem;
            }

            .privacy-card {
                padding: 22px;
            }

            .back-btn {
                left: 14px;
                top: 88px;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <section class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Privacy Policy</h1>
            <p>Your confidentiality and data protection</p>
        </div>
    </section>

    <button class="back-btn" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>

    <main class="privacy-wrap">
        <section class="privacy-card">
            <h2>Our Commitment</h2>
            <p>
                At Pinwntha Gems, we respect your confidentiality and we are committed to protecting it.
            </p>
        </section>

        <section class="privacy-card">
            <h2>Collection of Information</h2>
            <p>
                In order to respond to your questions, fulfill your requests or manage your accounts, it may be
                necessary to collect personal information such as your name, address, e-mail address and telephone
                number.
            </p>
            <p>
                We may use this information to respond to your requests, or to contact you via mail, e-mail or phone
                to inform you of new products, services or promotions we may offer.
            </p>
            <p>
                We may request further information when you enter competitions, use promotions/special offers, or use
                services such as subscribing to our mailing list.
            </p>
        </section>

        <section class="privacy-card">
            <h2>Subscribers</h2>
            <p>
                If you subscribe to our mailing list, we collect your e-mail address to send product updates or
                promotional materials. We do not use your e-mail address for unrelated purposes.
            </p>
        </section>

        <section class="privacy-card">
            <h2>Personal Information</h2>
            <p>
                Any information provided to facilitate operations or customer service is kept confidential.
            </p>
            <p>
                We do not trade, sell, rent or share crucial personal information to any third party without your
                express permission, except where necessary to comply with laws, police investigation, or legal
                proceedings.
            </p>
            <p>
                Access to database information may be given to technical service providers only to the extent required
                to provide those services, and such parties are bound by confidentiality obligations.
            </p>
        </section>

        <section class="privacy-card">
            <h2>Data Security</h2>
            <p>
                While no data transmission over the Internet can be 100% secure, we strive to protect your personal
                information.
            </p>
            <p>
                Pinwntha Gems has taken steps to safeguard information collected online. Appropriate devices and secure
                personnel are in place to maintain data integrity, and information is handled with utmost care.
            </p>
        </section>

        <section class="privacy-card">
            <h2>Your Consent</h2>
            <p>
                By using our website, you consent to the collection, storage and usage of information provided to us.
                Any changes to this Privacy Policy will be posted on this page so you are always informed of current
                policies.
            </p>
        </section>
    </main>

    <x-footer />

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        if (menuToggle && navUl) {
            menuToggle.addEventListener('click', () => {
                navUl.classList.toggle('show');
            });
        }
    </script>
</body>

</html>
