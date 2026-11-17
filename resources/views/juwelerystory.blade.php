<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewellery Story</title>
    <link rel="icon" type="image/png" href="{{ asset('images/web_logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #222;
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
            position: sticky;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            height: 52vh;
            background: url('{{ asset('images/main_website/about_header.jpg') }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            padding: 0 18px;
        }

        .about-header .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .header-content {
            position: relative;
            z-index: 1;
            max-width: 860px;
            animation: fadeInUp 0.8s ease;
        }

        .header-content h1 {
            font-size: clamp(2rem, 4vw, 3.4rem);
            margin-bottom: 10px;
            font-weight: 800;
        }

        .header-content p {
            font-size: 1.08rem;
            line-height: 1.8;
            opacity: 0.95;
        }

        .gemstones-section {
            background: #fff8f0;
            padding: 80px 20px;
            text-align: center;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .gemstones-section h2 {
            font-size: clamp(1.9rem, 3vw, 2.8rem);
            color: #bfa16a;
            margin-bottom: 18px;
        }

        .gemstones-section p {
            color: #555;
            line-height: 1.9;
            font-size: 1.02rem;
        }

        .split-section {
            padding: 90px 8%;
        }

        .split-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            align-items: center;
            max-width: 1240px;
            margin: 0 auto;
        }

        .split-content .small {
            color: #bfa16a;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .split-content h2 {
            font-size: clamp(1.9rem, 3vw, 2.8rem);
            margin: 14px 0 14px;
            color: #252525;
        }

        .split-content p {
            color: #555;
            line-height: 1.9;
            margin-bottom: 24px;
        }

        .split-image img {
            width: 100%;
            border-radius: 22px;
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.11);
            display: block;
        }

        .learn-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #bfa16a;
            color: #fff;
            text-decoration: none;
            padding: 12px 26px;
            border-radius: 999px;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .learn-btn:hover {
            background: #a88c55;
            transform: translateY(-2px);
        }

        .banner-section {
            position: relative;
            min-height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 50px 20px;
            overflow: hidden;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.48);
        }

        .banner-content {
            position: relative;
            z-index: 1;
            max-width: 860px;
            color: #fff;
        }

        .banner-content .small {
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #f1d8a6;
            font-weight: 700;
        }

        .banner-content h2 {
            font-size: clamp(2rem, 3.6vw, 3rem);
            margin: 14px 0;
        }

        .banner-content p {
            line-height: 1.85;
            opacity: 0.95;
        }

        .material-section {
            background: linear-gradient(to right, #fff8f0, #f6eee2);
        }

        .gem-jewelry-banner {
            background: url('{{ asset('images/main_website/web_j2.jpg') }}') center/cover no-repeat;
        }

        .jewelry-type-section {
            background: linear-gradient(to right, #ffffff, #f8f3eb);
        }

        .special-banner {
            background: url('{{ asset('images/main_website/web_j3.jpg') }}') center/cover no-repeat;
        }

        .details-section {
            display: none;
            padding: 90px 20px;
            background: #fff8f0;
        }

        .details-wrap {
            max-width: 1220px;
            margin: 0 auto;
        }

        .details-title {
            text-align: center;
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: #bfa16a;
            margin-bottom: 12px;
        }

        .details-subtitle {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 34px;
            color: #555;
            line-height: 1.85;
        }

        .details-main-image {
            width: min(620px, 100%);
            margin: 0 auto 30px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.14);
        }

        .details-main-image img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .details-card {
            background: #fff;
            border: 1px solid rgba(191, 161, 106, 0.25);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .details-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .details-card-body {
            padding: 14px;
        }

        .details-card-body h3 {
            color: #8a6f3b;
            margin-bottom: 8px;
            font-size: 1.06rem;
        }

        .details-card-body p {
            color: #565656;
            line-height: 1.7;
            font-size: 0.92rem;
        }

        .type-learn-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 10px;
            background: #bfa16a;
            color: #fff;
            text-decoration: none;
            padding: 9px 16px;
            border-radius: 999px;
            font-size: 0.84rem;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .type-learn-btn:hover {
            background: #a88c55;
            transform: translateY(-1px);
        }

        #jtype-sub-details {
            display: none;
            padding: 90px 20px;
            background: linear-gradient(180deg, #fff8f0 0%, #fff 100%);
        }

        .jtype-sub-wrap {
            max-width: 1220px;
            margin: 0 auto;
        }

        .jtype-sub-title {
            text-align: center;
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: #bfa16a;
            margin-bottom: 12px;
        }

        .jtype-sub-desc {
            text-align: center;
            max-width: 920px;
            margin: 0 auto 36px;
            color: #555;
            line-height: 1.85;
        }

        .jtype-sub-list {
            display: grid;
            gap: 16px;
        }

        .jtype-sub-item {
            background: #fff;
            border: 1px solid rgba(191, 161, 106, 0.22);
            border-radius: 16px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 0;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.07);
        }

        .jtype-sub-item img {
            width: 100%;
            height: 100%;
            min-height: 165px;
            object-fit: cover;
            display: block;
        }

        .jtype-sub-item-body {
            padding: 16px 18px;
        }

        .jtype-sub-item-body h3 {
            color: #8a6f3b;
            margin-bottom: 8px;
            font-size: 1.08rem;
        }

        .jtype-sub-item-body p {
            color: #585858;
            line-height: 1.75;
            font-size: 0.94rem;
        }

        .jtype-sub-actions {
            text-align: center;
            margin-top: 36px;
        }

        .special-modern-wrap {
            max-width: 1220px;
            margin: 0 auto;
        }

        .special-modern-title {
            text-align: center;
            font-size: clamp(2rem, 3vw, 2.9rem);
            color: #bfa16a;
            margin-bottom: 12px;
        }

        .special-modern-desc {
            text-align: center;
            max-width: 940px;
            margin: 0 auto 36px;
            color: #555;
            line-height: 1.9;
            font-size: 1.02rem;
        }

        .special-modern-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .special-modern-card {
            background: linear-gradient(135deg, #ffffff 0%, #fff8ee 100%);
            border: 1px solid rgba(191, 161, 106, 0.26);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.08);
        }

        .special-modern-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            display: block;
        }

        .special-modern-body {
            padding: 16px 18px 18px;
        }

        .special-modern-body h3 {
            color: #8a6f3b;
            margin-bottom: 8px;
            font-size: 1.12rem;
        }

        .special-modern-body p {
            color: #585858;
            line-height: 1.75;
            font-size: 0.94rem;
        }

        .gemcat-modern-wrap {
            max-width: 1220px;
            margin: 0 auto;
        }

        .gemcat-modern-title {
            text-align: center;
            font-size: clamp(2rem, 3.1vw, 2.8rem);
            color: #bfa16a;
            margin-bottom: 14px;
        }

        .gemcat-modern-desc {
            text-align: center;
            max-width: 980px;
            margin: 0 auto 40px;
            color: #555;
            line-height: 1.9;
            font-size: 1.02rem;
        }

        .gemcat-item {
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(191, 161, 106, 0.22);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 22px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.07);
        }

        .gemcat-item h3 {
            color: #8a6f3b;
            margin-bottom: 10px;
            font-size: 1.22rem;
        }

        .gemcat-item p {
            color: #565656;
            line-height: 1.8;
            margin-top: 12px;
            font-size: 0.95rem;
        }

        .gemcat-item-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .gemcat-item-images img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            display: block;
        }

        .back-wrap {
            text-align: center;
            margin-top: 40px;
        }

        .back-btn {
            background: #bfa16a;
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
        }

        .back-btn:hover {
            background: #a88c55;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(22px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 980px) {
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

            .split-container {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 620px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .details-main-image img {
                height: 250px;
            }

            .gemcat-item-images {
                grid-template-columns: 1fr;
            }

            .jtype-sub-item {
                grid-template-columns: 1fr;
            }

            .special-modern-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 981px) {
            .menu-toggle {
                display: none;
            }
        }

        .footer {
            background: #f4f4f4;
            padding: 80px 90px 25px;
            font-family: 'Poppins', sans-serif;
        }

        .footer-container {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1.2fr;
            gap: 60px;
        }

        .footer-logo {
            width: 150px;
            height: 150px;
            max-width: 100%;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .footer-about p {
            padding-top: 0;
            font-size: 14px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
        }

        .footer-col h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #111;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-col ul li {
            margin-bottom: 14px;
        }

        .footer-col ul li a {
            text-decoration: none;
            font-size: 14px;
            color: #555;
            transition: all 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: #c9a96a;
            padding-left: 6px;
        }

        .footer-col p {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
            line-height: 1.7;
        }

        .footer-socials {
            display: flex;
            gap: 12px;
        }

        .footer-socials a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ffffff;
            color: #333;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .footer-socials a:hover {
            background: #c9a96a;
            color: #fff;
            transform: translateY(-3px);
        }

        .footer-bottom {
            width: 100%;
            border-top: 1px solid #ddd;
            margin-top: 60px;
            padding: 25px 0;
            text-align: center;
            background: #f8f8f8;
        }

        .footer-bottom p {
            margin: 0;
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        @media (max-width: 1200px) {
            .footer {
                padding: 70px 60px 25px;
            }
        }

        @media (max-width: 992px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
                gap: 50px;
            }
        }

        @media (max-width: 600px) {
            .footer {
                padding: 60px 25px 20px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-col h4 {
                margin-bottom: 18px;
            }

            .footer-bottom {
                margin-top: 40px;
                padding-top: 18px;
            }
        }

        .sa-hidden {
            opacity: 0;
            transition: opacity 0.7s ease, transform 0.7s ease;
            will-change: opacity, transform;
        }

        .sa-up {
            transform: translateY(34px);
        }

        .sa-ltr {
            transform: translateX(-38px);
        }

        .sa-rtl {
            transform: translateX(38px);
        }

        .sa-show {
            opacity: 1 !important;
            transform: translate(0, 0) !important;
        }
    </style>
</head>

<body>
    <x-navbar />

    <section id="jewelry-header" class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Jewellery Story</h1>
            <p>Elegant Jewellery Crafted With Timeless Beauty</p>
        </div>
    </section>

    <section class="gemstones-section">
        <div class="container">
            <h2>Sri Lanka: A Heritage of Fine Jewellery</h2>
            <p>
                For centuries, Sri Lanka has been admired not only for its precious gemstones but also for its rich tradition of fine jewellery craftsmanship. Skilled artisans transform gold, silver, and platinum together with brilliant gemstones into elegant pieces that reflect beauty, culture, and value. The jewellery industry blends heritage techniques with modern design, creating rings, necklaces, bracelets, earrings, and other accessories worn for both fashion and special occasions. Many jewellery designs also carry symbolic and cultural meanings, representing love, celebration, and personal identity. With creative craftsmanship and high-quality materials, Sri Lankan jewellery continues to shine in global markets as a symbol of elegance and artistry.

            </p>
        </div>
    </section>

    <section id="material-main" class="split-section material-section">
        <div class="split-container">
            <div class="split-content">
                <span class="small">Foundation Of Craft</span>
                <h2>Material Categories</h2>
                <p>
                    Jewellery starts with the right material. Gold, silver, platinum, and modern alloys each offer a
                    different look, durability level, and value. Material choice defines how a piece feels, performs,
                    and lasts for generations.
                </p>
                <a href="#" class="learn-btn material-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="split-image">
                <img src="{{ asset('images/main_website/web_j7.webp') }}" alt="Jewellery Materials">
            </div>
        </div>
    </section>

    <section id="gemcat-main" class="banner-section gem-jewelry-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <span class="small">Color & Character</span>
            <h2>Gemstone Categories for Jewellery</h2>
            <p>
                Precious and semi-precious gemstones bring identity to jewellery designs. Their color, clarity, and
                cut decide whether a piece feels classic, bold, regal, or modern.
            </p>
            <a href="#" class="learn-btn gemcat-btn">Learn More <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section id="jtype-main" class="split-section jewelry-type-section">
        <div class="split-container">
            <div class="split-content">
                <span class="small">Everyday To Occasion</span>
                <h2>Jewelry Type Categories</h2>
                <p>
                    Rings, earrings, necklaces, bangles, and pendants are designed for different style goals and
                    moments. Understanding jewelry types helps match aesthetics, comfort, and purpose.
                </p>
                <a href="#" class="learn-btn jtype-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="split-image">
                <img src="{{ asset('images/main_website/web_j8.webp') }}" alt="Jewelry Types">
            </div>
        </div>
    </section>

    <section id="special-main" class="banner-section special-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <span class="small">Signature Pieces</span>
            <h2>Special Collection</h2>
            <p>
                Our special collections blend heritage motifs with modern finishing. These limited pieces are crafted
                for milestones, gifting, and statement styling.
            </p>
            <a href="#" class="learn-btn special-btn">Learn More <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section id="material-details" class="details-section">
        <div style="max-width:1200px; margin:auto;">
            <h2 style="text-align:center; font-size:2.6rem; color:#bfa16a; margin-bottom:20px;">
                Material Categories in Jewellery
            </h2>

            <p style="text-align:center; max-width:900px; margin:auto; font-size:1.05rem; line-height:1.8; color:#555; margin-bottom:60px;">
                Jewellery materials determine durability, color tone, maintenance, and value. From classic gold and
                silver to modern alloys, each category has unique qualities that influence design style and daily
                wearability.
            </p>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_j9.jpeg') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Gold</h3>
                    <p>
                        Gold remains one of the most iconic and valuable materials in the jewelry industry. Known for
                        its timeless beauty and lasting value, gold has been used in jewelry for centuries across many
                        cultures. It is available in different colors such as yellow gold, white gold, and rose gold,
                        each offering a unique style and appearance. Gold is also categorized by purity levels like
                        24K, 22K, and 18K. Because of its elegance and durability, gold is widely used in bridal
                        jewelry, engagement rings, necklaces, bangles, and heirloom pieces that are passed down
                        through generations.
                    </p>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_j10.jpg') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Sterling Silver</h3>
                    <p>
                        Sterling silver is a highly popular metal in modern jewelry due to its bright white shine and
                        affordable price. It is made from 92.5% pure silver mixed with small amounts of other metals
                        to increase strength and durability. Sterling silver is widely used for earrings, pendants,
                        bracelets, rings, and minimalist jewelry designs. Its versatility allows it to match both
                        casual and formal fashion styles. With proper care and occasional polishing, sterling silver
                        jewelry maintains its beautiful shine and remains a durable and elegant choice for everyday
                        wear.
                    </p>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_j11.jpeg') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Platinum</h3>
                    <p>
                        Platinum is a rare and luxurious metal widely valued in high-end jewelry. It is known for its
                        exceptional strength, purity, and naturally white color that does not fade or tarnish easily.
                        Because of its durability, platinum is an excellent choice for securely holding precious
                        gemstones such as diamonds and sapphires. This metal is commonly used in engagement rings,
                        wedding bands, and luxury fine jewelry. Platinum jewelry also offers a sophisticated and modern
                        appearance, making it a preferred choice for people who appreciate long-lasting elegance and
                        premium craftsmanship.
                    </p>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_j12.webp') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Brass</h3>
                    <p>
                        Brass is a versatile alloy made primarily from copper and zinc, known for its warm golden
                        color. It is often used in artistic and fashion jewelry because it can be easily shaped and
                        engraved into detailed designs. Brass jewelry works beautifully in handcrafted pieces,
                        vintage-inspired ornaments, and bold statement accessories. Its antique golden tone gives
                        jewelry a unique character that blends traditional and contemporary styles. Designers often use
                        brass to create textured finishes and intricate patterns, making it popular in bohemian,
                        heritage-inspired, and modern fashion collections.
                    </p>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_13.webp') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Copper</h3>
                    <p>
                        Copper jewelry is admired for its rich reddish-brown color and natural handcrafted appearance.
                        This metal has been used in jewelry making for thousands of years and is often associated with
                        traditional and artisan craftsmanship. Copper is commonly used in rings, bracelets, cuffs, and
                        spiritual or cultural ornaments. It pairs beautifully with natural gemstones, turquoise, and
                        oxidized finishes that enhance its rustic beauty. Because of its earthy tone and unique
                        character, copper jewelry is often chosen by people who appreciate bold, handmade designs and
                        natural artistic expression.
                    </p>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_j13.webp') }}" style="width:100%; border-radius:15px;">
                </div>
                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Modern Mixed Alloys</h3>
                    <p>
                        Modern jewelry design frequently uses mixed metal alloys to improve strength, durability, and
                        design flexibility. By blending different metals together, jewelers can create pieces that are
                        lightweight, affordable, and resistant to wear. These alloys allow designers to experiment with
                        new shapes, textures, and finishes while maintaining a polished appearance. Mixed alloys are
                        commonly used in contemporary jewelry collections, especially for daily wear and fashion
                        accessories. They support innovative and trend-driven designs while ensuring that the jewelry
                        remains strong, stylish, and comfortable for everyday use.
                    </p>
                </div>
            </div>

            <div style="text-align:center; margin-top:60px;">
                <button id="backMaterial"
                    style="background:#bfa16a; color:#fff; padding:12px 30px; border:none; border-radius:40px; cursor:pointer;">
                    Back to story
                </button>
            </div>
        </div>
    </section>

    <section id="gemcat-details" class="details-section">
        <div class="gemcat-modern-wrap">
            <h2 class="gemcat-modern-title">Gemstone Categories for Jewellery</h2>
            <p class="gemcat-modern-desc">
                Discover jewellery gemstone categories by style and purpose. Below, each collection is presented
                individually with visual references and a quick description to help you compare tones, elegance,
                symbolism, and design direction.
            </p>

            <div class="gemcat-item">
                <h3>Sapphire Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j14.webp') }}" alt="Sapphire Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j15.webp') }}" alt="Sapphire Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j16.jpeg') }}" alt="Sapphire Jewelry 3">
                </div>
                <p>Sapphire jewelry is admired for its deep royal blue tones and remarkable brilliance. This precious gemstone symbolizes wisdom, loyalty, and protection, making it a meaningful choice for elegant jewelry. Often set in gold or platinum, sapphire pieces are perfect for rings, necklaces, and earrings that combine timeless luxury with durability. Sri Lanka is famous for producing some of the world's finest sapphires, valued for their clarity and vibrant color. Sapphire jewelry is ideal for both formal occasions and everyday sophistication, offering a refined look that never goes out of style.</p>
            </div>

            <div class="gemcat-item">
                <h3>Ruby Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j17.jpg') }}" alt="Ruby Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j18.webp') }}" alt="Ruby Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j19.jpg') }}" alt="Ruby Jewelry 3">
                </div>
                <p>Ruby jewelry is known for its striking red color and powerful symbolism. Often associated with passion, love, and courage, rubies have been treasured for centuries by royalty and collectors. Their rich crimson hue makes them a standout gemstone in rings, pendants, earrings, and bracelets. When set in gold or combined with diamonds, ruby jewelry creates a bold and luxurious appearance. This gemstone is also believed in astrology to bring confidence, vitality, and leadership qualities. Ruby pieces are perfect for those who appreciate vibrant elegance and timeless beauty.</p>
            </div>

            <div class="gemcat-item">
                <h3>Emerald Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j20.jpg') }}" alt="Emerald Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j21.webp') }}" alt="Emerald Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j22.jpg') }}" alt="Emerald Jewelry 3">
                </div>
                <p>Emerald jewelry is celebrated for its lush green color and sophisticated charm. Known as a symbol of renewal, harmony, and wisdom, emeralds have been treasured since ancient times. These gemstones are commonly featured in elegant rings, necklaces, and earrings, often paired with diamonds to enhance their brilliance. Emerald jewelry offers a vintage and regal look, making it popular in heirloom and heritage-inspired designs. With its rich color and unique natural inclusions, each emerald piece carries a distinctive character that reflects both luxury and natural beauty.</p>
            </div>

            <div class="gemcat-item">
                <h3>Navarathna Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j23.jpg') }}" alt="Navarathna Jewelry 1">
                    <img src="{{ asset('images/main_website/wb_j24.jpg') }}" alt="Navarathna Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j24.jfif') }}" alt="Navarathna Jewelry 3">
                </div>
                <p>Navarathna jewelry is a unique and spiritually significant style that features nine different gemstones in one design. Each stone represents a planet in Vedic astrology, including ruby, pearl, red coral, emerald, yellow sapphire, diamond, blue sapphire, hessonite, and cat's eye. Together, these gems are believed to balance planetary energies and bring harmony, protection, and prosperity to the wearer. Navarathna rings, pendants, and bracelets are popular in many cultures for their symbolic meaning and colorful appearance. This jewelry blends spiritual significance with vibrant beauty.</p>
            </div>

            <div class="gemcat-item">
                <h3>Birthstone Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j25.webp') }}" alt="Birthstone Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j26.png') }}" alt="Birthstone Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j27.webp') }}" alt="Birthstone Jewelry 3">
                </div>
                <p>Birthstone jewelry is a meaningful and personalized form of adornment, where each gemstone represents a specific month of birth. These gemstones are believed to carry unique symbolism and positive energies connected to personality, protection, and good fortune. Birthstone pieces make thoughtful gifts for birthdays, anniversaries, or special milestones. Common designs include rings, necklaces, bracelets, and earrings featuring the birthstone of the wearer. By combining beauty with personal meaning, birthstone jewelry creates a deeper emotional connection and celebrates individuality through color and symbolism.</p>
            </div>

            <div class="gemcat-item">
                <h3>Diamond Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j28.webp') }}" alt="Diamond Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j29.webp') }}" alt="Diamond Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j30.webp') }}" alt="Diamond Jewelry 3">
                </div>
                <p>Diamond jewelry is the ultimate symbol of luxury, brilliance, and timeless beauty. Known as the hardest natural gemstone, diamonds are valued for their durability and unmatched sparkle. They are widely used in engagement rings, wedding jewelry, necklaces, and elegant earrings. Diamonds represent love, commitment, and strength, making them a popular choice for special occasions and lifelong memories. When set in gold or platinum, diamond jewelry offers a sophisticated and classic appearance that never loses its charm. Its enduring value and brilliance make it one of the most desired gemstones in the world.</p>
            </div>

            <div class="gemcat-item">
                <h3>Pearl Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j31.webp') }}" alt="Pearl Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j32.jpg') }}" alt="Pearl Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j33.jpg') }}" alt="Pearl Jewelry 3">
                </div>
                <p>Pearl jewelry is admired for its soft glow and timeless elegance. Unlike other gemstones, pearls are formed naturally within oysters, giving them a smooth and organic beauty. They are often associated with purity, grace, and emotional balance. Pearl necklaces, earrings, and bracelets are popular choices for weddings, formal events, and classic everyday fashion. Their gentle luster complements both traditional and modern styles. Because of their refined simplicity, pearls remain a symbol of sophistication and femininity in jewelry design.</p>
            </div>

            <div class="gemcat-item">
                <h3>Semi-Precious Gem Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j34.webp') }}" alt="Semi Precious Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j35.jpg') }}" alt="Semi Precious Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j36.webp') }}" alt="Semi Precious Jewelry 3">
                </div>
                <p>Semi-precious gemstone jewelry offers a vibrant variety of colors and styles, making it a popular choice for creative and modern designs. These gemstones include stones such as amethyst, garnet, topaz, and aquamarine, each valued for its unique beauty and symbolism. Semi-precious gems are often used in rings, pendants, bracelets, and earrings, allowing jewelers to create colorful and affordable luxury pieces. With their wide color range and versatility, semi-precious gemstones bring freshness and individuality to jewelry collections while remaining elegant and accessible.</p>
            </div>

            <div class="gemcat-item">
                <h3>Precious Gem Collection</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j37.jpg') }}" alt="Precious Gem Collection 1">
                    <img src="{{ asset('images/main_website/web_j38.jpg') }}" alt="Precious Gem Collection 2">
                    <img src="{{ asset('images/main_website/web_j39.jpg') }}" alt="Precious Gem Collection 3">
                </div>
                <p>Precious gemstone collections focus on the world's most valuable and sought-after stones, including ruby, sapphire, emerald, and diamond. These gemstones are prized for their rarity, beauty, and lasting value. Jewelry featuring precious gems often showcases expert craftsmanship, premium cuts, and elegant settings that highlight the brilliance of each stone. Such collections are ideal for luxury jewelry, heirloom pieces, and investment-grade gemstones. The combination of exceptional quality and timeless design makes precious gem jewelry highly admired by collectors and enthusiasts.</p>
            </div>

            <div class="gemcat-item">
                <h3>Custom Gemstone Jewelry</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j40.jpg') }}" alt="Custom Gemstone Jewelry 1">
                    <img src="{{ asset('images/main_website/web_j41.jpg') }}" alt="Custom Gemstone Jewelry 2">
                    <img src="{{ asset('images/main_website/web_j42.jfif') }}" alt="Custom Gemstone Jewelry 3">
                </div>
                <p>Custom gemstone jewelry allows individuals to create unique pieces that reflect their personal style, stories, and special moments. Customers can choose their preferred gemstone, metal type, design, and setting to craft a one-of-a-kind jewelry item. Whether it is an engagement ring, pendant, bracelet, or family heirloom piece, custom jewelry provides complete creative freedom. Skilled artisans carefully design and craft each piece to match the client's vision. This personalized approach transforms jewelry into a meaningful work of art that holds sentimental value and individuality.</p>
            </div>

            <div class="gemcat-item">
                <h3>Natural Certified Gemstones</h3>
                <div class="gemcat-item-images">
                    <img src="{{ asset('images/main_website/web_j43.webp') }}" alt="Natural Certified Gemstones 1">
                    <img src="{{ asset('images/main_website/web_j45.jpg') }}" alt="Natural Certified Gemstones 2">
                    <img src="{{ asset('images/main_website/web_j44.webp') }}" alt="Natural Certified Gemstones 3">
                </div>
                <p>Natural certified gemstones guarantee authenticity, quality, and trust in the jewelry market. These gemstones are tested and verified by professional gemological laboratories to confirm their natural origin and characteristics. Certification ensures that the stone's quality, color, clarity, and weight are accurately documented. Buyers can feel confident knowing they are investing in genuine gemstones. Certified stones are especially important for valuable gems such as sapphire, ruby, emerald, and diamond. Choosing natural certified gemstones ensures transparency, reliability, and long-term value in fine jewelry.</p>
            </div>

            <div class="back-wrap">
                <button id="backGemcat" class="back-btn">Back to story</button>
            </div>
        </div>
    </section>

    <section id="jtype-details" class="details-section">
        <div class="details-wrap">
            <h2 class="details-title">Jewelry Type Categories</h2>
            <p class="details-subtitle">
                Explore jewelry by type to quickly compare style, purpose, and occasion. From everyday essentials to
                bridal and ceremonial pieces, each category below is designed with its own character and craftsmanship.
            </p>
            <div class="details-grid">
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j46.webp') }}" alt="Rings">
                    <div class="details-card-body">
                        <h3>Rings</h3>
                        <p>Classic personal jewelry for everyday wear, gifting, and symbolic milestones.</p>
                        <a href="#" class="type-learn-btn" data-jtype="rings">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j47.webp') }}" alt="Necklaces">
                    <div class="details-card-body">
                        <h3>Necklaces</h3>
                        <p>Statement and layering pieces that frame the neckline with elegance.</p>
                        <a href="#" class="type-learn-btn" data-jtype="necklaces">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j48.webp') }}" alt="Bracelets">
                    <div class="details-card-body">
                        <h3>Bracelets</h3>
                        <p>Flexible wrist jewelry ranging from sleek minimal styles to gem-rich designs.</p>
                        <a href="#" class="type-learn-btn" data-jtype="bracelets">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j49.webp') }}" alt="Earrings">
                    <div class="details-card-body">
                        <h3>Earrings</h3>
                        <p>Studs, drops, and hoops for subtle elegance or bold modern styling.</p>
                        <a href="#" class="type-learn-btn" data-jtype="earrings">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j50.jpg') }}" alt="Pendants">
                    <div class="details-card-body">
                        <h3>Pendants</h3>
                        <p>Single-focus gemstone or motif pieces designed for personal meaning.</p>
                        <a href="#" class="type-learn-btn" data-jtype="pendants">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_51.jfif') }}" alt="Bangles">
                    <div class="details-card-body">
                        <h3>Bangles</h3>
                        <p>Traditional and contemporary circular wrist styles for festive wear.</p>
                        <a href="#" class="type-learn-btn" data-jtype="bangles">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j52.webp') }}" alt="Engagement Rings">
                    <div class="details-card-body">
                        <h3>Engagement Rings</h3>
                        <p>Iconic center-stone rings crafted to mark proposals and lifelong commitment.</p>
                        <a href="#" class="type-learn-btn" data-jtype="engagement">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j53.webp') }}" alt="Wedding Jewelry">
                    <div class="details-card-body">
                        <h3>Wedding Jewelry</h3>
                        <p>Coordinated ceremonial sets designed to complement bridal and groom attire.</p>
                        <a href="#" class="type-learn-btn" data-jtype="wedding">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="details-card">
                    <img src="{{ asset('images/main_website/web_j54.jpg') }}" alt="Men's Jewelry">
                    <div class="details-card-body">
                        <h3>Men's Jewelry</h3>
                        <p>Bold and structured pieces including rings, chains, bracelets, and pendants.</p>
                        <a href="#" class="type-learn-btn" data-jtype="mens">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="back-wrap">
                <button id="backJtype" class="back-btn">Back to story</button>
            </div>
        </div>
    </section>

    <section id="jtype-sub-details">
        <div class="jtype-sub-wrap">
            <h2 id="jtypeSubTitle" class="jtype-sub-title">Jewelry Type Details</h2>
            <p id="jtypeSubDesc" class="jtype-sub-desc">
                Explore each sub-category and choose pieces by style, occasion, and personality.
            </p>
            <div id="jtypeSubList" class="jtype-sub-list"></div>
            <div class="jtype-sub-actions">
                <button id="backJtypeSub" class="back-btn">Back to Jewelry Types</button>
            </div>
        </div>
    </section>

    <section id="special-details" class="details-section">
        <div class="special-modern-wrap">
            <h2 class="special-modern-title">Special Collections</h2>
            <p class="special-modern-desc">
                Our Special Collections are curated to reflect distinct moods and occasions, from bridal grandeur and
                astrological symbolism to luxury styling and modern minimalism. Explore each line below for signature
                craftsmanship and standout design identity.
            </p>

            <div class="special-modern-grid">
                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j103.webp') }}" alt="Bridal Collection">
                    <div class="special-modern-body">
                        <h3>Bridal Collection</h3>
                        <p>The Bridal Collection features exquisite jewelry pieces designed to complement the beauty and elegance of wedding celebrations. These sets often include coordinated necklaces, earrings, bangles, and rings crafted with precious metals and sparkling gemstones. Rich detailing, intricate craftsmanship, and luxurious finishes make bridal jewelry perfect for ceremonial occasions. Inspired by traditional and contemporary wedding styles, this collection enhances the bride's overall appearance while symbolizing love, prosperity, and new beginnings. Bridal jewelry is carefully designed to create a grand and memorable look for one of life's most important and cherished moments.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j104.jpg') }}" alt="Astrology Collection">
                    <div class="special-modern-body">
                        <h3>Astrology Collection</h3>
                        <p>The Astrology Collection is inspired by the ancient belief that gemstones carry cosmic energy connected to planets and zodiac signs. Each piece in this collection is thoughtfully designed using gemstones associated with specific planetary influences. These jewels are believed to bring balance, protection, prosperity, and positive energy to the wearer. Popular gemstones include ruby, sapphire, emerald, and yellow sapphire, each linked to different astrological meanings. Combining spiritual symbolism with elegant craftsmanship, the Astrology Collection offers jewelry that is not only beautiful but also meaningful for those who follow astrological traditions.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j105.webp') }}" alt="Luxury Collection">
                    <div class="special-modern-body">
                        <h3>Luxury Collection</h3>
                        <p>The Luxury Collection showcases the finest jewelry designs crafted with high-value gemstones and exceptional attention to detail. These pieces feature premium materials such as diamonds, sapphires, rubies, and emeralds set in gold or platinum. The designs emphasize brilliance, precision, and artistic craftsmanship to create statement jewelry that reflects sophistication and elegance. Perfect for special occasions or exclusive events, the Luxury Collection represents prestige, refinement, and timeless beauty. Each piece is designed to stand out while maintaining a graceful and polished appearance.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j106.webp') }}" alt="Traditional Collection">
                    <div class="special-modern-body">
                        <h3>Traditional Collection</h3>
                        <p>The Traditional Collection celebrates the rich heritage of classic South Asian jewelry craftsmanship. These pieces are inspired by cultural motifs, intricate patterns, and time-honored design techniques passed down through generations. Traditional jewelry often includes detailed gold work, vibrant gemstones, and symbolic elements that reflect cultural identity and artistry. This collection is perfect for festivals, weddings, and ceremonial occasions where heritage and elegance are celebrated. By blending tradition with fine craftsmanship, these designs preserve the beauty and significance of classic jewelry styles.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j107.webp') }}" alt="Modern Collection">
                    <div class="special-modern-body">
                        <h3>Modern Collection</h3>
                        <p>The Modern Collection focuses on contemporary jewelry designs that reflect simplicity, elegance, and everyday versatility. Clean lines, minimalist settings, and innovative shapes create pieces that match modern fashion trends. These designs are often lightweight and comfortable, making them perfect for daily wear while still maintaining sophistication. Modern jewelry combines traditional craftsmanship with fresh design ideas, offering stylish accessories suitable for both casual and professional settings. This collection appeals to individuals who appreciate sleek and fashionable jewelry with a contemporary touch.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j108.webp') }}" alt="Limited Edition">
                    <div class="special-modern-body">
                        <h3>Limited Edition</h3>
                        <p>The Limited Edition Collection features rare and exclusive jewelry pieces created in small quantities. These designs highlight artistic creativity, unique gemstone combinations, and distinctive craftsmanship. Because they are produced in limited numbers, each piece carries a sense of exclusivity and individuality. Limited edition jewelry is highly valued by collectors and enthusiasts who seek rare designs that stand out from mass-produced items. This collection offers distinctive creations that celebrate originality, creativity, and the beauty of exceptional jewelry design.</p>
                    </div>
                </article>

                <article class="special-modern-card">
                    <img src="{{ asset('images/main_website/web_j108.jpg') }}" alt="Custom Design Jewelry">
                    <div class="special-modern-body">
                        <h3>Custom Design Jewelry</h3>
                        <p>The Custom Design Jewelry collection allows customers to create one-of-a-kind pieces that reflect their personal stories and style. Clients can choose the gemstone, metal type, design concept, and special details to craft a truly unique jewelry item. Whether it is an engagement ring, pendant, bracelet, or family heirloom, custom jewelry transforms personal ideas into beautifully crafted pieces. Skilled artisans carefully design and produce each item to ensure quality and uniqueness. Custom jewelry not only highlights individuality but also creates meaningful pieces that hold lasting emotional value.</p>
                    </div>
                </article>
            </div>

            <div class="back-wrap">
                <button id="backSpecial" class="back-btn">Back to story</button>
            </div>
        </div>
    </section>

    <x-footer />

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        if (menuToggle && navUl) {
            menuToggle.addEventListener('click', () => {
                navUl.classList.toggle('show');
            });
        }

        const headerSection = document.getElementById('jewelry-header');
        const gemstonesIntro = document.querySelector('.gemstones-section');
        const materialMain = document.getElementById('material-main');
        const gemcatMain = document.getElementById('gemcat-main');
        const jtypeMain = document.getElementById('jtype-main');
        const specialMain = document.getElementById('special-main');

        const materialDetails = document.getElementById('material-details');
        const gemcatDetails = document.getElementById('gemcat-details');
        const jtypeDetails = document.getElementById('jtype-details');
        const jtypeSubDetails = document.getElementById('jtype-sub-details');
        const specialDetails = document.getElementById('special-details');

        const materialBtn = document.querySelector('.material-btn');
        const gemcatBtn = document.querySelector('.gemcat-btn');
        const jtypeBtn = document.querySelector('.jtype-btn');
        const specialBtn = document.querySelector('.special-btn');

        const backMaterial = document.getElementById('backMaterial');
        const backGemcat = document.getElementById('backGemcat');
        const backJtype = document.getElementById('backJtype');
        const backJtypeSub = document.getElementById('backJtypeSub');
        const backSpecial = document.getElementById('backSpecial');

        const jtypeSubTitle = document.getElementById('jtypeSubTitle');
        const jtypeSubDesc = document.getElementById('jtypeSubDesc');
        const jtypeSubList = document.getElementById('jtypeSubList');

        const typeDetailsData = {
            rings: {
                title: "Rings",
                desc: "Rings are one of the most popular forms of jewelry, worn as symbols of love, commitment, fashion, and personal expression. They can feature gemstones, diamonds, or minimalist metal designs and are available in many styles for both men and women. Rings are commonly worn daily and also used for engagements, weddings, and special celebrations.",
                items: [
                    { name: "Gemstone Rings", image: "{{ asset('images/main_website/web_j22.jpg') }}", para: "Gemstone rings feature natural or precious stones set in gold, silver, or platinum. Popular gemstones include sapphire, ruby, emerald, and amethyst. These rings are admired for their vibrant colors and symbolic meanings. Gemstone rings are often worn for fashion, astrology, or as statement jewelry pieces." },
                    { name: "Diamond Rings", image: "{{ asset('images/main_website/web_j29.webp') }}", para: "Diamond rings represent elegance, brilliance, and timeless beauty. Known for their sparkle and durability, diamonds are commonly used in engagement and luxury rings. These rings symbolize love, strength, and commitment, making them a popular choice for special occasions and lifelong memories." },
                    { name: "Navarathna Rings", image: "{{ asset('images/main_website/web_j23.jpg') }}", para: "Navarathna rings feature nine different gemstones representing the nine planets in Vedic astrology. These rings are believed to bring balance, protection, and positive energy to the wearer. With their colorful design and spiritual meaning, Navarathna rings are both meaningful and visually striking." },
                    { name: "Birthstone Rings", image: "{{ asset('images/main_website/web_j18.webp') }}", para: "Birthstone rings include a gemstone that represents a person's birth month. Each stone carries unique symbolism and meaning, making these rings highly personal and meaningful. Birthstone rings are often given as gifts for birthdays, anniversaries, or special milestones." },
                    { name: "Couple Rings", image: "{{ asset('images/main_website/web_j55.webp') }}", para: "Couple rings are matching or complementary rings worn by partners to symbolize love and commitment. These rings are often exchanged by couples to celebrate relationships, anniversaries, or promises. They represent unity, connection, and shared memories." },
                    { name: "Adjustable Rings", image: "{{ asset('images/main_website/web_j56.jpeg') }}", para: "Adjustable rings are designed with flexible bands that can fit different finger sizes comfortably. They are convenient and practical, especially for gifting. Adjustable rings come in many styles including gemstone, minimalist, and decorative designs." },
                    { name: "Statement Rings", image: "{{ asset('images/main_website/web_j57.webp') }}", para: "Statement rings are bold and eye-catching jewelry pieces designed to stand out. They often feature large gemstones, unique shapes, or artistic designs. Statement rings are perfect for adding personality and elegance to both casual and formal outfits." },
                    { name: "Men's Rings", image: "{{ asset('images/main_website/web_j58.webp') }}", para: "Men's rings are designed with stronger shapes and bold styles. These rings may feature gemstones, engraved patterns, or minimalist metal bands. They are commonly worn as fashion accessories, wedding bands, or symbolic jewelry." }
                ]
            },
            necklaces: {
                title: "Necklaces",
                desc: "Necklaces are elegant jewelry pieces worn around the neck to enhance style and appearance. They come in many designs, including chains, gemstone pieces, and decorative pendants. Necklaces can be worn daily or for special occasions.",
                items: [
                    { name: "Gold Necklaces", image: "{{ asset('images/main_website/web_j3.jpg') }}", para: "Gold necklaces are timeless and luxurious jewelry pieces made from pure or alloyed gold. They are popular for both everyday wear and traditional ceremonies. Gold necklaces often feature intricate craftsmanship and lasting value." },
                    { name: "Gemstone Necklaces", image: "{{ asset('images/main_website/web_j17.jpg') }}", para: "Gemstone necklaces highlight the beauty of natural stones such as sapphire, ruby, emerald, and topaz. These necklaces bring vibrant colors and symbolic meanings, making them perfect for both fashion and spiritual significance." },
                    { name: "Diamond Necklaces", image: "{{ asset('images/main_website/web_j59.jpg') }}", para: "Diamond necklaces are known for their brilliance and sophistication. They often feature sparkling diamonds set in elegant chains or pendants. Diamond necklaces are ideal for formal occasions and luxurious styling." },
                    { name: "Bridal Necklaces", image: "{{ asset('images/main_website/web_j60.jpg') }}", para: "Bridal necklaces are designed specifically for wedding ceremonies. They often include intricate gold work, gemstones, or traditional patterns that complement bridal attire. These necklaces enhance the bride's elegance and cultural beauty." },
                    { name: "Layered Necklaces", image: "{{ asset('images/main_website/web_j61.jfif') }}", para: "Layered necklaces feature multiple chains worn together to create a stylish layered look. They are popular in modern fashion and allow different lengths and designs to be combined for a trendy appearance." },
                    { name: "Choker Necklaces", image: "{{ asset('images/main_website/web_j62.jpg') }}", para: "Choker necklaces sit closely around the neck and create a bold and fashionable statement. They are available in metal, gemstone, or decorative styles and are widely used in modern and traditional fashion." },
                    { name: "Pendant Necklaces", image: "{{ asset('images/main_website/web_j50.jpg') }}", para: "Pendant necklaces feature a decorative charm or gemstone hanging from a chain. The pendant often carries symbolic meaning, making these necklaces both stylish and meaningful." }
                ]
            },
            bracelets: {
                title: "Bracelets",
                desc: "Bracelets are jewelry pieces worn around the wrist to add elegance and style. They come in many designs including chains, gemstones, charms, and bangles. Bracelets can be worn alone or layered for a fashionable look.",
                items: [
                    { name: "Gemstone Bracelets", image: "{{ asset('images/main_website/web_j63.jpg') }}", para: "Gemstone bracelets include natural stones that bring color and symbolic meaning. These bracelets are admired for their beauty and are often associated with astrology, healing, or personal style." },
                    { name: "Gold Bracelets", image: "{{ asset('images/main_website/web_j64.webp') }}", para: "Gold bracelets are classic jewelry pieces valued for their elegance and durability. They are commonly worn for both everyday fashion and special occasions, offering a luxurious and timeless look." },
                    { name: "Silver Bracelets", image: "{{ asset('images/main_website/web_j65.webp') }}", para: "Silver bracelets are stylish and affordable accessories with a bright, elegant shine. They are versatile and suitable for both casual and formal outfits." },
                    { name: "Charm Bracelets", image: "{{ asset('images/main_website/web_j66.jpg') }}", para: "Charm bracelets feature small decorative charms attached to the chain. Each charm can represent memories, interests, or personal milestones, making these bracelets highly meaningful." },
                    { name: "Tennis Bracelets", image: "{{ asset('images/main_website/web_j67.webp') }}", para: "Tennis bracelets are elegant bracelets featuring a continuous line of gemstones or diamonds. They are known for their delicate design and timeless beauty." },
                    { name: "Adjustable Bracelets", image: "{{ asset('images/main_website/web_j68.jfif') }}", para: "Adjustable bracelets are designed with flexible closures to fit different wrist sizes comfortably. They are practical, stylish, and easy to wear." },
                    { name: "Men's Bracelets", image: "{{ asset('images/main_website/web_j69.webp') }}", para: "Men's bracelets feature bold and masculine designs, often made with metal chains, leather, or gemstones. They add personality and style to men's fashion." }
                ]
            },
            earrings: {
                title: "Earrings",
                desc: "Earrings are one of the most popular jewelry accessories worn to enhance facial beauty and personal style. They come in many forms including studs, hoops, and drop designs.",
                items: [
                    { name: "Stud Earrings", image: "{{ asset('images/main_website/web_j70.jfif') }}", para: "Stud earrings are small and elegant pieces that sit directly on the ear. They are simple, comfortable, and suitable for everyday wear." },
                    { name: "Drop Earrings", image: "{{ asset('images/main_website/web_j71.jpg') }}", para: "Drop earrings hang slightly below the earlobe and add graceful movement and elegance to the wearer's appearance." },
                    { name: "Hoop Earrings", image: "{{ asset('images/main_website/web_j72.webp') }}", para: "Hoop earrings are circular or semi-circular designs that create a bold and fashionable look. They are available in many sizes and styles." },
                    { name: "Chandbali Earrings", image: "{{ asset('images/main_website/web_j73.jfif') }}", para: "Chandbali earrings are traditional crescent-shaped earrings inspired by Indian and South Asian heritage jewelry designs." },
                    { name: "Gemstone Earrings", image: "{{ asset('images/main_website/fp_3.jpg') }}", para: "Gemstone earrings feature colorful stones such as sapphire, ruby, and emerald, adding elegance and vibrant beauty." },
                    { name: "Bridal Earrings", image: "{{ asset('images/main_website/web_j74.webp') }}", para: "Bridal earrings are designed to complement wedding attire and add luxury and sophistication to the bride's overall look." },
                    { name: "Kids Earrings", image: "{{ asset('images/main_website/web_j75.jfif') }}", para: "Kids earrings are smaller and lightweight designs created for comfort and safety while still being stylish and cute." }
                ]
            },
            pendants: {
                title: "Pendants",
                desc: "Pendants are decorative jewelry pieces worn on chains around the neck. They often feature gemstones, symbols, initials, or artistic designs that add personal meaning and beauty. Pendants are versatile accessories suitable for both casual and formal styles. Many people choose pendants to express personality, beliefs, or special memories through elegant and meaningful designs.",
                items: [
                    { name: "Gemstone Pendants", image: "{{ asset('images/main_website/web_j76.webp') }}", para: "Gemstone pendants showcase the beauty of natural stones such as sapphire, ruby, emerald, and amethyst. These pendants highlight vibrant colors and unique brilliance, making them eye-catching jewelry pieces. Gemstone pendants are often worn for their symbolic meanings, astrological significance, or simply for their elegant and timeless beauty." },
                    { name: "Initial Pendants", image: "{{ asset('images/main_website/web_j77.webp') }}", para: "Initial pendants feature the first letter of a name, creating a simple yet meaningful piece of personalized jewelry. They are popular gifts for birthdays, anniversaries, or special occasions. Initial pendants offer a stylish way to represent personal identity while adding a modern and elegant touch to everyday fashion." },
                    { name: "Religious Pendants", image: "{{ asset('images/main_website/web_j78.jfif') }}", para: "Religious pendants symbolize faith, spirituality, and personal belief. These pendants may include sacred symbols, spiritual icons, or meaningful religious designs. Many people wear them for protection, guidance, or devotion. Religious pendants combine deep spiritual meaning with beautiful craftsmanship, making them treasured pieces of jewelry." },
                    { name: "Zodiac Pendants", image: "{{ asset('images/main_website/web_j79.jpg') }}", para: "Zodiac pendants represent the twelve astrological signs and are worn by people who connect with astrology and cosmic symbolism. These pendants highlight zodiac symbols or constellation designs linked to personality traits and birth dates. Zodiac pendants are meaningful accessories that express identity and spiritual connection." },
                    { name: "Heart Pendants", image: "{{ asset('images/main_website/web_j80.webp') }}", para: "Heart pendants are timeless symbols of love, affection, and emotional connection. They are often given as romantic gifts between partners or as meaningful tokens of friendship and family love. Heart pendants come in many styles, from simple metal designs to gemstone-decorated pieces that add elegance and sentiment." },
                    { name: "Custom Name Pendants", image: "{{ asset('images/main_website/web_j81.png') }}", para: "Custom name pendants allow individuals to wear their name or a loved one's name as a personalized jewelry piece. These pendants are specially crafted with unique lettering styles and metal choices. Custom name pendants are popular gifts and meaningful keepsakes that celebrate identity and personal relationships." }
                ]
            },
            bangles: {
                title: "Bangles",
                desc: "Bangles are circular jewelry pieces worn around the wrist and are especially popular in traditional and cultural fashion. They are available in various materials such as gold, silver, and gemstone designs. Bangles can be worn individually or stacked together for a richer and more decorative look.",
                items: [
                    { name: "Gold Bangles", image: "{{ asset('images/main_website/web_j82.webp') }}", para: "Gold bangles are classic jewelry pieces valued for their beauty, durability, and cultural significance. They are commonly worn during weddings, festivals, and celebrations. Gold bangles often feature detailed craftsmanship and elegant patterns, making them both fashionable accessories and valuable heirloom items." },
                    { name: "Stone Bangles", image: "{{ asset('images/main_website/web_j83.jfif') }}", para: "Stone bangles include colorful gemstones or decorative stones set into metal bangles. These designs add vibrancy and sparkle to traditional wrist jewelry. Stone bangles are often worn for festive occasions or cultural celebrations, enhancing the beauty of traditional attire." },
                    { name: "Bridal Bangles", image: "{{ asset('images/main_website/web_j84.webp') }}", para: "Bridal bangles are specially designed for wedding ceremonies and are often part of a bride's complete jewelry set. These bangles usually feature gold, gemstones, and intricate traditional designs. Bridal bangles symbolize prosperity, happiness, and the beginning of a new life." },
                    { name: "Openable Bangles", image: "{{ asset('images/main_website/web_j85.jpg') }}", para: "Openable bangles are designed with a clasp or hinge, allowing them to be easily worn and removed. These bangles provide comfort and convenience while maintaining an elegant appearance. They are ideal for both everyday wear and special occasions." },
                    { name: "Kada Bangles", image: "{{ asset('images/main_website/web_j86.jfif') }}", para: "Kada bangles are thicker and more solid bracelet-style bangles often worn as bold statement pieces. They are popular in both men's and women's jewelry and often feature engraved patterns or gemstone accents." },
                    { name: "Kids Bangles", image: "{{ asset('images/main_website/web_j87.webp') }}", para: "Kids bangles are specially designed for children with lightweight materials and comfortable sizes. These bangles are often simple, safe, and decorated with small designs that appeal to young wearers." }
                ]
            },
            engagement: {
                title: "Engagement Rings",
                desc: "Engagement rings symbolize love, commitment, and the promise of marriage. They are traditionally given during a proposal and often feature diamonds or precious gemstones. Engagement rings are designed to represent everlasting love and are cherished as meaningful lifelong jewelry pieces.",
                items: [
                    { name: "Solitaire Rings", image: "{{ asset('images/main_website/web_j88.webp') }}", para: "Solitaire rings feature a single prominent gemstone, usually a diamond, set in a simple yet elegant design. The focus on one stone highlights its brilliance and beauty. Solitaire rings are among the most classic and popular engagement ring styles." },
                    { name: "Halo Rings", image: "{{ asset('images/main_website/web_j89.jfif') }}", para: "Halo rings feature a central gemstone surrounded by a circle of smaller stones, creating extra sparkle and brilliance. This design enhances the appearance of the center stone, making it look larger and more radiant." },
                    { name: "Three-Stone Rings", image: "{{ asset('images/main_website/web_j90.png') }}", para: "Three-stone rings feature three gemstones representing the past, present, and future of a relationship. This meaningful design is often chosen for engagement rings or anniversary gifts." },
                    { name: "Vintage Style Rings", image: "{{ asset('images/main_website/web_j91.jpg') }}", para: "Vintage-style rings are inspired by classic jewelry designs from past eras. They often feature intricate details, delicate engravings, and antique-style settings that create a timeless and romantic appearance." },
                    { name: "Custom Engagement Rings", image: "{{ asset('images/main_website/web_j92.jpg') }}", para: "Custom engagement rings allow couples to design a unique ring that reflects their personal style and love story. Customers can choose the gemstone, metal, and setting to create a one-of-a-kind symbol of commitment." }
                ]
            },
            wedding: {
                title: "Wedding Jewelry",
                desc: "Wedding jewelry includes elegant pieces worn during wedding ceremonies by both the bride and groom. These designs often feature precious metals and gemstones that enhance the beauty of wedding attire and symbolize love and celebration.",
                items: [
                    { name: "Bridal Sets", image: "{{ asset('images/main_website/web_j93.webp') }}", para: "Bridal sets are coordinated jewelry collections that typically include necklaces, earrings, and sometimes bracelets or bangles. These sets are designed to complement bridal dresses and create a complete wedding look." },
                    { name: "Wedding Rings", image: "{{ asset('images/main_website/web_j94.webp') }}", para: "Wedding rings are exchanged during the marriage ceremony as symbols of lifelong commitment and unity. These rings are usually simple bands made of gold, platinum, or other precious metals." },
                    { name: "Wedding Necklaces", image: "{{ asset('images/main_website/web_j95.webp') }}", para: "Wedding necklaces are elegant pieces worn by brides to enhance their wedding attire. They often feature intricate designs, gemstones, or pearls that highlight beauty and tradition." },
                    { name: "Traditional Sets", image: "{{ asset('images/main_website/web_j96.jpg') }}", para: "Traditional jewelry sets include culturally inspired designs often worn during weddings and special ceremonies. These sets reflect heritage, craftsmanship, and timeless elegance." },
                    { name: "Groom Jewelry", image: "{{ asset('images/main_website/web_j97.jpeg') }}", para: "Groom jewelry includes accessories worn by the groom during weddings, such as rings, chains, cufflinks, or bracelets. These pieces add sophistication and style to the groom's attire." }
                ]
            },
            mens: {
                title: "Men's Jewelry",
                desc: "Men's jewelry includes stylish accessories designed specifically for masculine fashion. These pieces often feature bold designs, durable materials, and minimalistic details that complement modern and classic styles.",
                items: [
                    { name: "Men's Rings", image: "{{ asset('images/main_website/web_j98.jpg') }}", para: "Men's rings are bold and stylish accessories worn for fashion, symbolism, or commitment. They often feature strong designs, metal bands, or gemstone accents." },
                    { name: "Men's Chains", image: "{{ asset('images/main_website/web_j99.jpg') }}", para: "Men's chains are strong and stylish necklaces designed with masculine patterns and durable metals. They can be worn alone or with pendants for a modern look." },
                    { name: "Men's Bracelets", image: "{{ asset('images/main_website/web_j100.jfif') }}", para: "Men's bracelets include metal, leather, or gemstone designs that add personality and style to everyday fashion." },
                    { name: "Cufflinks", image: "{{ asset('images/main_website/web_j101.jfif') }}", para: "Cufflinks are elegant accessories used to fasten shirt cuffs in formal attire. They add sophistication and detail to suits and formal clothing." },
                    { name: "Men's Pendants", image: "{{ asset('images/main_website/web_j102.webp') }}", para: "Men's pendants are bold and meaningful accessories worn with chains. They may include symbols, initials, or simple geometric designs that reflect personal style." }
                ]
            }
        };

        function hideMainSections() {
            headerSection.style.display = 'flex';
            gemstonesIntro.style.display = 'none';
            materialMain.style.display = 'none';
            gemcatMain.style.display = 'none';
            jtypeMain.style.display = 'none';
            specialMain.style.display = 'none';
        }

        function showMainSections() {
            headerSection.style.display = 'flex';
            gemstonesIntro.style.display = 'block';
            materialMain.style.display = 'block';
            gemcatMain.style.display = 'flex';
            jtypeMain.style.display = 'block';
            specialMain.style.display = 'flex';
        }

        function hideAllDetails() {
            materialDetails.style.display = 'none';
            gemcatDetails.style.display = 'none';
            jtypeDetails.style.display = 'none';
            jtypeSubDetails.style.display = 'none';
            specialDetails.style.display = 'none';
        }

        materialBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hideMainSections();
            hideAllDetails();
            materialDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        gemcatBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hideMainSections();
            hideAllDetails();
            gemcatDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        jtypeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hideMainSections();
            hideAllDetails();
            jtypeDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        specialBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hideMainSections();
            hideAllDetails();
            specialDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backMaterial.addEventListener('click', () => {
            hideAllDetails();
            showMainSections();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backGemcat.addEventListener('click', () => {
            hideAllDetails();
            showMainSections();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backJtype.addEventListener('click', () => {
            hideAllDetails();
            showMainSections();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        document.querySelectorAll('.type-learn-btn').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const key = btn.dataset.jtype;
                const data = typeDetailsData[key];
                if (!data) return;

                jtypeSubTitle.textContent = data.title;
                jtypeSubDesc.textContent = data.desc;
                jtypeSubList.innerHTML = data.items.map((item) => `
                    <article class="jtype-sub-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="jtype-sub-item-body">
                            <h3>${item.name}</h3>
                            <p>${item.para}</p>
                        </div>
                    </article>
                `).join('');

                hideAllDetails();
                jtypeSubDetails.style.display = 'block';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        backJtypeSub.addEventListener('click', () => {
            hideAllDetails();
            jtypeDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backSpecial.addEventListener('click', () => {
            hideAllDetails();
            showMainSections();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        (function initJewelleryStoryScrollAnimations() {
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (reduceMotion || typeof IntersectionObserver === 'undefined') return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('sa-show');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });

            const watch = (el) => {
                if (!el || el.dataset.saBound === '1') return;
                el.dataset.saBound = '1';
                observer.observe(el);
            };

            document.querySelectorAll('section').forEach((section) => {
                const isDetailsSection = (section.id || '').includes('details');
                const isInitiallyHidden = getComputedStyle(section).display === 'none';

                if (isDetailsSection || isInitiallyHidden) {
                    section.classList.add('sa-show');
                    return;
                }

                section.classList.add('sa-hidden', 'sa-up');
                watch(section);
            });

            document.querySelectorAll('.split-container').forEach((container) => {
                const imageCol = container.querySelector('.split-image');
                const contentCol = container.querySelector('.split-content');
                if (!imageCol || !contentCol) return;

                const imageFirst = imageCol.compareDocumentPosition(contentCol) & Node.DOCUMENT_POSITION_FOLLOWING;

                imageCol.classList.add('sa-hidden', imageFirst ? 'sa-ltr' : 'sa-rtl');
                contentCol.classList.add('sa-hidden', imageFirst ? 'sa-rtl' : 'sa-ltr');
                watch(imageCol);
                watch(contentCol);
            });

            document.querySelectorAll('.details-card, .special-modern-card, .jtype-card, .jtype-sub-item').forEach((card, idx) => {
                card.classList.add('sa-hidden', 'sa-up');
                card.style.transitionDelay = `${(idx % 8) * 80}ms`;
                watch(card);
            });
        })();
    </script>
    <x-scroll-animations />
</body>

</html>
