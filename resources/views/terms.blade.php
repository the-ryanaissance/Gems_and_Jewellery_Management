<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions | Pinwntha Gems</title>
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

        nav ul li:hover > .dropdown {
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
            font-weight: 400;
            letter-spacing: 1px;
            margin: 0;
        }

        .terms-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px 30px;
        }

        .terms-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            padding: 30px;
            margin-bottom: 20px;
        }

        .terms-card h2 {
            color: #bfa16a;
            margin: 0 0 12px;
            font-size: 1.4rem;
        }

        .terms-card p,
        .terms-card li {
            color: #444;
            line-height: 1.8;
            font-size: 0.98rem;
        }

        .terms-card ul {
            margin: 0;
            padding-left: 18px;
        }

        .policy-note {
            border-left: 4px solid #bfa16a;
            background: #faf5ea;
            padding: 14px 16px;
            border-radius: 10px;
            margin-top: 14px;
            color: #3f372d;
            font-weight: 600;
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

            .terms-card {
                padding: 22px;
            }

            .back-btn {
                left: 14px;
                top: 88px;
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
    </style>
</head>

<body>
    <x-navbar />

    <section class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Terms & Conditions</h1>
            <p>About our online store and terms of use</p>
        </div>
    </section>

    <button class="back-btn" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>

    <main class="terms-wrap">
        <section class="terms-card">
            <h2>About Our Online Store and Terms of Use</h2>
            <p>
                The Pinwntha Gems & Jewellery Online Store has its registered office in Sri Lanka. The website
                application is owned and managed by Pinwntha Gems & Jewellery (Pvt) Ltd.
            </p>
            <p>
                These Terms of Use govern your use of the Pinwntha Gems & Jewellery Online Store. In these Terms of
                Use, we use the terms “Pinwntha Gems”, “we”, “us” and “our” to refer to Pinwntha Gems & Jewellery
                (Private) Limited and its affiliates.
            </p>
            <p>
                Please read these Terms of Use carefully before using our Online Store. By using our Online Store, you
                signify your acceptance of these Terms of Use. If you do not agree, you are not authorized to continue
                using the Online Store.
            </p>
        </section>

        <section class="terms-card">
            <h2>Revisions</h2>
            <p>
                Pinwntha Gems reserves the right to revise these Terms and Conditions at any time in such manner as
                Pinwntha Gems shall, at its sole direction, determine.
            </p>
            <p>
                All typographical errors in any quotation, Terms and Conditions, or on the website and/or Online Store
                shall be subject to correction by Pinwntha Gems.
            </p>
        </section>

        <section class="terms-card">
            <h2>Representation and Warranty</h2>
            <p>
                You warrant and undertake to comply with all applicable laws and regulations in relation to the use of
                the Site and/or Online Store and confirm that you have read, understood and agree unconditionally to
                be bound by our Terms and Conditions.
            </p>
            <p>
                Pinwntha Gems shall not be liable or responsible in any manner whatsoever for any breach,
                non-compliance or infringement of any laws, rules and regulations governing the use of the Site,
                caused by or attributable to you.
            </p>
        </section>

        <section class="terms-card">
            <h2>Products</h2>
            <p>
                All communications made by Pinwntha Gems on the Site are invitations to treat only. Any order placed
                by you is an offer to contract and is not binding until acceptance is communicated by our customer
                service executive.
            </p>
            <p>
                Pinwntha Gems reserves the right to refuse any and all offers made by you for any reason, including
                changes in pricing or availability of relevant product(s).
            </p>
            <ul>
                <li>Purchased products will be reserved only for 24 hours until 100% payment is made.</li>
                <li>Prices and availability are subject to change at our sole and absolute discretion.</li>
                <li>Products may be re-priced, withdrawn, revised or discontinued at any time.</li>
                <li>Product photos/descriptions on the Site may vary from actual products.</li>
            </ul>
        </section>

        <section class="terms-card">
            <h2>Exclusion of Liability</h2>
            <p>
                Pinwntha Gems shall not in any circumstances be liable (to the extent permitted by applicable law) for
                direct, indirect, special, consequential, or economic loss arising from failure to perform obligations
                due to electronic, electrical, mechanical, computer-related failures, errors, omissions, interruptions,
                or delays.
            </p>
        </section>

        <section class="terms-card">
            <h2>Engraving</h2>
            <p>
                We engrave jewellery to order. You may request a name, initials, a significant date, or short phrase
                to personalize your piece and create a meaningful gift.
            </p>
        </section>

        <section class="terms-card">
            <h2>Jewellery Care</h2>
            <ul>
                <li>Gold is durable but may scratch or dent with harsh handling.</li>
                <li>Rings and bracelets are more susceptible to impact damage.</li>
                <li>Dust, moisture, perspiration and makeup may reduce shine over time.</li>
                <li>Avoid acids, abrasives, chlorine, and harsh chemicals.</li>
                <li>Remove jewellery before swimming pools, hot tubs, and bleach use.</li>
                <li>Wear jewellery after applying perfume and makeup.</li>
                <li>Store each piece separately in a box/pouch or soft cloth.</li>
                <li>Use silica gel/anti-tarnish strips to reduce moisture and tarnish risk.</li>
                <li>Avoid wearing silver jewellery while swimming in chlorinated water.</li>
            </ul>
            <p>
                This is our guarantee to customers on the purity and quality of metals used in our collections.
            </p>
        </section>

        <section class="terms-card">
            <h2>Payment Options</h2>
            <p>100% bank transfer or direct deposit should be made to our official company account.</p>
            <ul>
                <li>Name of the Bank: Hatton National Bank PLC</li>
                <li>Account No: 1150-10149671</li>
                <li>SWIFT Code: HBLILKLX</li>
                <li>Beneficiary: Pinwntha Gems & Jewellery (Pvt) Ltd</li>
                <li>HNB Bank Code: 7083</li>
                <li>Branch Code: 115</li>
            </ul>
            <p class="policy-note">
                Special Policy: For any gem or jewellery item above LKR 25,000, only in-store pickup is available.
                Delivery is not available for those orders.
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
