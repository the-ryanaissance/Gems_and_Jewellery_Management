<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gems & Jewelry</title>
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
            position: sticky;
            
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

        nav ul li a:hover,
        nav ul li a.active {
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

        
        nav ul li:hover .dropdown {
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

        
        
        

        .hero {
            position: relative;
            width: 100%;
            height: 85vh;
            overflow: hidden;
        }

        .hero-slider {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
        }

        .slide.active {
            opacity: 1;
            z-index: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(60%);
        }

        
        .slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(191, 161, 106, 0.3));
        }

        
        .hero-content {
            position: absolute;
            top: 30%;
            left: 10%;
            transform: translateY(-50%);
            color: white;
            max-width: 600px;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 1.8rem;
            color: #f1f1f1;
        }

        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 1 1 220px;
            max-width: 240px;
            width: 100%;
            height: 54px;
            padding: 0 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #bfa16a, #e6c67a);
            transition: all 0.4s ease;
            box-sizing: border-box;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: stretch;
        }

        .astro-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex: 1 1 220px;
            max-width: 240px;
            width: 100%;
            height: 54px;
            padding: 0 1.4rem;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            border-radius: 999px;
            background: linear-gradient(135deg, #214841, #2f6f65 58%, #bfa16a);
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: 0 14px 30px rgba(33, 72, 65, 0.35);
            position: relative;
            overflow: hidden;
            transition: transform 0.35s ease, box-shadow 0.35s ease, filter 0.35s ease;
            box-sizing: border-box;
        }

        .astro-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.22), transparent 45%, rgba(255, 255, 255, 0.08));
            transform: translateX(-120%);
            transition: transform 0.7s ease;
        }

        .astro-btn:hover {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 18px 36px rgba(33, 72, 65, 0.42);
            filter: saturate(1.08);
        }

        .astro-btn:hover::before {
            transform: translateX(120%);
        }

        .astro-btn i {
            font-size: 0.95rem;
        }

        .login-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(18, 14, 8, 0.58);
            backdrop-filter: blur(4px);
            z-index: 2000;
        }

        .login-modal.open {
            display: flex;
        }

        .login-modal-card {
            width: min(100%, 440px);
            background: #fff;
            border-radius: 18px;
            border: 1px solid #eadcc0;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .22);
            padding: 24px 22px 20px;
            display: block;
        }

        .login-modal-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .login-modal-head h3 {
            margin: 0;
            color: #1c1c1c;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.35rem;
            line-height: 1.1;
        }

        .login-modal-close {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 50%;
            background: #f3e5cb;
            color: #5d4722;
            font-size: 1rem;
            cursor: pointer;
            flex: 0 0 auto;
            display: inline-grid;
            place-items: center;
        }

        .login-modal-card p {
            margin: 0;
            color: #5e5e5e;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .login-modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .login-modal-actions .btn {
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
        }

        .login-modal-actions .btn.secondary {
            background: #efe3c8;
            color: #634f2c;
            box-shadow: none;
        }

        .login-modal-actions .btn.primary {
            background: linear-gradient(135deg, #c9a96a, #b89250);
        }

        .login-modal-actions .btn:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 720px) {
            .login-modal-card {
                padding: 22px 18px 18px;
                border-radius: 16px;
            }

            .login-modal-close {
                width: 34px;
                height: 34px;
                font-size: 0.95rem;
            }

            .login-modal-actions .btn {
                flex: 1 1 0;
                min-width: 0;
                max-width: none;
                height: 46px;
                padding: 0 14px;
            }
        }

        
        .slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .slider-dots div {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: 2px solid #fff;
            cursor: pointer;
            transition: 0.3s;
        }

        .slider-dots .active {
            background: #bfa16a;
            transform: scale(1.3);
            box-shadow: 0 0 10px rgba(191, 161, 106, 0.8);
        }

        
        .slide .hero-content {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .slide.active .hero-content {
            opacity: 1;
            transform: translateY(0);
        }

        
        @media (max-width: 768px) {
            .hero-content {
                left: 5%;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }


        
        
        

        .our-story-section {
            padding: 80px 8%;
            background: #f9f9f9;
        }

        .story-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        
        .story-images {
            flex: 1;
            display: flex;
            gap: 20px;
        }

        .story-images img {
            width: 50%;
            height: auto;
            border-radius: 15px;
            object-fit: cover;
        }

        
        .story-content {
            flex: 1;
        }

        .story-content h3 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .story-content p {
            line-height: 1.7;
            color: #555;
            margin-bottom: 30px;
        }


        
        .story-btn {
            display: inline-block;
            padding: 12px 28px;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #bfa16a, #e6c67a);
            transition: all 0.4s ease;


        }

        .story-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        
        @media(max-width: 768px) {
            .story-container {
                flex-direction: column;
            }

            .story-images img {
                width: 100%;
            }
        }


        
        
        
        

        .featured-products-section {
            padding: 30px 8%;
            background: #fafafa;
            
            background: url("images/main_website/web_back2.jpg") center/cover no-repeat;
        }


        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .section-header p {
            color: #666;
            text-align: center;
        }

        

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        

        @media(max-width:1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width:900px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:600px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.4s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-8px);
        }

        

        .product-image {
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        

        .view-shop-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #bfa16a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            opacity: 0;
            transition: 0.4s;
        }

        .product-card:hover .view-shop-btn {
            opacity: 1;
        }

        

        .product-info {
            padding: 20px;
            text-align: center;
        }

        .category {
            font-size: 12px;
            color: #999;
        }

        .product-info h4 {
            margin: 10px 0;
        }

        .price {
            font-weight: bold;
            font-size: 20px;
        }

        

        .bottom-btn-wrapper {
            margin-top: 60px;
            text-align: center;
        }

        

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #bfa16a, #e6c67a);
            transition: all 0.4s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }


        
        
        

        .modern-banner-section {
            padding: 80px 8%;
            background: #fff;
            height: 70vh;
        }

        .banner-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        

        .modern-banner-card {
            position: relative;
            height: 420px;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            padding: 40px;
            color: #fff;
            text-decoration: none;
        }

        

        .banner-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.6s ease;
            z-index: 1;
        }

        

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 2;
        }

        

        .banner-content {
            position: relative;
            z-index: 3;
            max-width: 320px;
        }

        .banner-subtitle {
            font-size: 13px;
            letter-spacing: 2px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .banner-content h3 {
            font-size: 34px;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .banner-content p {
            font-size: 14px;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        

        .banner-btn {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 50px;
            background: linear-gradient(135deg, #bfa16a, #e6c67a);
            font-weight: 600;
            transition: all 0.4s ease;
        }

        

        .modern-banner-card:hover .banner-bg {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        .modern-banner-card:hover .banner-btn {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        

        @media(max-width:900px) {
            .banner-grid {
                grid-template-columns: 1fr;
            }
        }


        
        
        

        .category-section {
            width: 100%;
            padding: 40px 4%;
            background: #f5f5f5;
        }

        

        .category-row {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            gap: 15px;
        }

        

        .category-card {
            background: #e9e9e9;
            border-radius: 18px;
            padding: 22px 10px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        

        .category-icon {
            width: 60px;
            height: 60px;
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
            width: 55px;
            height: 55px;
            object-fit: contain;

            
            filter: brightness(0) saturate(100%) invert(74%) sepia(32%) saturate(600%) hue-rotate(10deg);
            transition: 0.3s ease;
        }

        

        .category-card h4 {
            font-size: 13px;
            font-weight: 500;
            margin: 0;
            transition: 0.3s;
        }

        

        .category-card:hover {
            background: #fff;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(191, 161, 106, 0.25);
        }

        .category-card:hover .category-icon {
            background: linear-gradient(135deg, #bfa16a, #e6c67a);
        }

        .category-card:hover img {
            filter: brightness(0) invert(1);
            
        }

        .category-card:hover h4 {
            color: #bfa16a;
        }

        .category-filter-wrap {
            margin-top: 28px;
            background: #fff;
            border: 1px solid #e9dfcc;
            border-radius: 18px;
            padding: 18px;
        }

        .category-filter-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .category-filter-head h3 {
            margin: 0;
            color: #242424;
            font-size: 1.2rem;
        }

        .filter-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .filter-control label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #8b7a5a;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .filter-control select {
            width: 100%;
            border: 1px solid #ddd3c1;
            border-radius: 10px;
            padding: 10px 12px;
            background: #fff;
            color: #333;
            font-size: 0.95rem;
        }

        .filter-products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .filter-product-card {
            background: #f9f9f9;
            border: 1px solid #ece4d5;
            border-radius: 14px;
            overflow: hidden;
            display: block;
            text-decoration: none;
            color: inherit;
            transition: .25s ease;
        }

        .filter-product-card:hover {
            transform: translateY(-3px);
            border-color: #d6bc8d;
            box-shadow: 0 8px 18px rgba(191, 161, 106, .18);
        }

        .filter-product-media {
            background: #efefef;
            padding: 12px;
        }

        .filter-product-media img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
        }

        .filter-product-body {
            padding: 10px 12px 12px;
        }

        .filter-product-meta {
            margin: 0 0 5px;
            color: #9a9a9a;
            font-size: .74rem;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 700;
        }

        .filter-product-name {
            margin: 0 0 6px;
            font-size: .95rem;
            color: #202020;
            line-height: 1.35;
        }

        .filter-product-price {
            margin: 0;
            color: #111;
            font-size: 1.15rem;
            font-weight: 800;
        }

        .filter-empty {
            display: none;
            margin-top: 8px;
            text-align: center;
            color: #6b6b6b;
            font-size: .95rem;
        }

        @media(max-width:900px) {
            .filter-controls {
                grid-template-columns: 1fr;
            }

            .filter-products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width:560px) {
            .filter-products-grid {
                grid-template-columns: 1fr;
            }
        }


        
        
        

        .review-section {
            width: 100%;
            padding: 80px 0;
            background: #fafafa;
            overflow: hidden;
            
            background: url("images/main_website/web_back2.jpg") center/cover no-repeat;
        }

        .review-container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        

        .review-left-side {
            flex: 1;
        }

        .review-eyebrow {
            letter-spacing: 3px;
            font-size: 14px;
            color: #b08a44;
            margin-bottom: 20px;
        }

        .review-headline {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 40px;
        }

        

        .review-happy-row {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .review-avatars {
            display: flex;
            align-items: center;
        }

        .review-avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #fff;
            margin-left: -15px;
            background: #ddd;
        }

        .review-avatar-circle:first-child {
            margin-left: 0;
        }

        .review-avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .review-avatar-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #111, #6b5a2e);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        .review-avatar-circle.plus {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            color: #fff;
            font-weight: 600;
        }

        

        .review-happy-text .review-big {
            font-size: 28px;
            font-weight: 600;
        }

        .review-happy-text .review-small {
            font-size: 13px;
            letter-spacing: 2px;
            color: #777;
        }

        

        .review-right-side {
            flex: 1;
            position: relative;
        }

        

        .review-slider {
            position: relative;
            background: #fff;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        

        .review-slide {
            display: none;
            animation: fadeSlide 0.6s ease;
        }

        .review-slide.active {
            display: block;
        }

        

        .review-rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .review-rating-number {
            font-size: 40px;
            font-weight: 600;
        }

        .review-stars-note {
            text-align: right;
        }

        .review-stars {
            color: #ffb400;
            font-size: 20px;
        }

        .review-note {
            font-size: 13px;
            color: #888;
        }

        

        .review-text {
            font-size: 18px;
            line-height: 1.6;
            color: #444;
            margin-bottom: 30px;
        }

        .review-product {
            margin-top: 2px;
            color: #9a7a2a;
            font-size: 13px;
        }

        

        .review-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .review-avatar-circle.small {
            width: 45px;
            height: 45px;
            margin-left: 0;
        }

        

        .review-dots {
            text-align: center;
            margin-top: 25px;
        }

        .review-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            margin: 0 6px;
            cursor: pointer;
        }

        .review-dot.active {
            width: 25px;
            border-radius: 20px;
            background: #000;
            transition: 0.3s;
        }

        

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        

        @media(max-width:900px) {
            .review-container {
                flex-direction: column;
                text-align: center;
            }

            .review-happy-row {
                justify-content: center;
            }

            .review-rating {
                flex-direction: column;
                gap: 10px;
            }

            .review-stars-note {
                text-align: center;
            }
        }

        .review-slide {
            display: none;
        }

        .review-slide.active {
            display: block;
        }

        .services-section {
            width: 100%;
            padding: 80px 0;
            background: #f9f9f9;
        }

        .services-container {
            width: 90%;
            max-width: 1200px;
            margin: auto;

            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }


        
        
        

        .services-section {
            padding: 80px 0;
            background: #faf7f2;
        }

        

        .services-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .services-header h2 {
            font-size: 40px;
            color: #c9a96a;
            margin-bottom: 10px;
        }

        .services-header p {
            color: #666;
            font-size: 15px;
        }

        

        .services-container {
            width: 90%;
            max-width: 1200px;
            margin: auto;

            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        

        .services-card {
            background: #fff;
            padding: 35px 25px;
            text-align: center;
            border-radius: 22px;

            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: 0.4s ease;
        }

        

        .services-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.2);
        }

        

        .services-icon-img {
            width: 60px;
            height: 60px;
            object-fit: contain;

            display: block;
            margin: 0 auto 20px auto;

            
            filter: brightness(0) saturate(100%) invert(57%) sepia(48%) saturate(494%) hue-rotate(5deg) brightness(90%) contrast(90%);
        }

        

        .services-title {
            font-size: 18px;
            font-weight: 600;
            color: #c9a96a;
            margin-bottom: 12px;
        }

        

        .services-text {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        

        @media(max-width:992px) {
            .services-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:600px) {
            .services-container {
                grid-template-columns: 1fr;
            }

            .services-header h2 {
                font-size: 30px;
            }
        }

        

        .promo-banner {
            position: relative;
            width: 90%;
            margin: 80px auto;
            padding: 80px 40px;

            border-radius: 30px;
            overflow: hidden;

            background: url("images/main_website/web_back3.jpg");
            background-size: cover;
            background-position: center;
        }

        

        .promo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.55);
        }

        

        .promo-content {
            position: relative;
            z-index: 2;
            max-width: 650px;
            color: #fff;
        }

        

        .promo-subtitle {
            color: #c9a96a;
            letter-spacing: 2px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        

        .promo-title {
            font-size: 42px;
            line-height: 1.3;
            margin-bottom: 25px;
        }

        

        .promo-text {
            font-size: 15px;
            line-height: 1.7;
            color: #ddd;
            margin-bottom: 35px;
        }

        

        .promo-btn {
            display: inline-block;
            padding: 14px 30px;

            background: #c9a96a;
            color: #fff;
            text-decoration: none;

            border-radius: 50px;
            font-weight: 500;

            transition: 0.4s;
        }

        .promo-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        

        @media(max-width:768px) {

            .promo-banner {
                width: 95%;
                padding: 60px 25px;
            }

            .promo-title {
                font-size: 30px;
            }
        }

        

        .newsletter-section {
            padding: 80px 0;
            background: #faf7f2;
            background: url("images/main_website/web_back2.jpg") center/cover no-repeat;
        }

        .newsletter-container {
            width: 90%;
            max-width: 1100px;
            margin: auto;

            background: #fff;
            border-radius: 30px;

            padding: 60px 40px;

            text-align: center;

            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        

        .newsletter-content h2 {
            font-size: 40px;
            color: #c9a96a;
            margin-bottom: 15px;
        }

        .newsletter-content p {
            color: #666;
            margin-bottom: 40px;
            font-size: 15px;
        }

        

        .newsletter-form {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .newsletter-form input {
            width: 350px;
            max-width: 100%;

            padding: 15px 20px;
            border-radius: 50px;

            border: 1px solid #ddd;
            outline: none;

            font-size: 15px;
        }

        .newsletter-btn {
            padding: 15px 30px;
            background: #c9a96a;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 50px;
            font-weight: 500;

            transition: 0.4s;
        }

        .newsletter-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(191, 161, 106, 0.4);
        }

        .newsletter-success,
        .newsletter-error {
            margin-top: 10px;
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 0.95rem;
        }

        .newsletter-success {
            background: #edf7ee;
            border: 1px solid #c9e8ce;
            color: #245f30;
        }

        .newsletter-error {
            background: #fff0ea;
            border: 1px solid #f0d2c7;
            color: #9c4d3d;
        }

        

        @media(max-width:600px) {

            .newsletter-container {
                padding: 40px 20px;
            }

            .newsletter-content h2 {
                font-size: 28px;
            }

            .newsletter-form input {
                width: 100%;
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
            margin-bottom: 0px;
            padding-bottom: 0px;
        }

        

        .footer-about p {
            padding-top: 0px;
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

        

        .active-link {
            color: #000 !important;
            font-weight: 600;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
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
            border-top: 1px solid #bfb6a7;
            margin-top: 60px;
            padding: 25px 0;
            text-align: center;
            background: transparent;
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
</head>

<body class="home-page">

    <x-navbar />

    <section class="hero">
        <div class="hero-slider">

            <div class="slide active">
                <img src="{{ asset('images/main_website/web_hero1.jpg') }}" alt="">
                <div class="hero-content">
                    <h1>Timeless Diamond Collection</h1>
                    <p>Discover brilliance crafted with passion and perfection.</p>
                    <div class="hero-actions">
                        <a href="{{ route('jewellery') }}" class="btn">Shop Now</a>
                        @auth
                            <a href="{{ route('astrology') }}" class="astro-btn"><i class="fas fa-moon"></i> Explore Astrology</a>
                        @else
                            <a href="{{ route('signin') }}" class="astro-btn js-astro-gate" data-login-url="{{ route('signin') }}"><i class="fas fa-moon"></i> Explore Astrology</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="slide">
                <img src="{{ asset('images/main_website/web_hero3.jpg') }}" alt="">
                <div class="hero-content">
                    <h1>Luxury Gemstone Jewelry</h1>
                    <p>Experience elegance that defines your style.</p>
                    <div class="hero-actions">
                        <a href="{{ route('gems') }}" class="btn">Explore Collection</a>
                        @auth
                            <a href="{{ route('astrology') }}" class="astro-btn"><i class="fas fa-moon"></i> Find Your Sign</a>
                        @else
                            <a href="{{ route('signin') }}" class="astro-btn js-astro-gate" data-login-url="{{ route('signin') }}"><i class="fas fa-moon"></i> Find Your Sign</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="slide">
                <img src="{{ asset('images/main_website/web_hero2.jpg') }}" alt="">
                <div class="hero-content">
                    <h1>Crafted For Special Moments</h1>
                    <p>Celebrate love with our exclusive rings.</p>
                    <div class="hero-actions">
                        <a href="{{ route('jewellery') }}" class="btn">View Rings</a>
                        @auth
                            <a href="{{ route('astrology') }}" class="astro-btn"><i class="fas fa-star"></i> Zodiac Guide</a>
                        @else
                            <a href="{{ route('signin') }}" class="astro-btn js-astro-gate" data-login-url="{{ route('signin') }}"><i class="fas fa-star"></i> Zodiac Guide</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="slider-dots"></div>

        </div>
    </section>

    
    <section class="our-story-section">
        <div class="story-container">

            
            <div class="story-images">
                <img src="{{ asset('images/main_website/web_about_img1.jpg') }}" alt="Story Image 1">
                <img src="{{ asset('images/main_website/web_about_img2.jpg') }}" alt="Story Image 2">
            </div>

            
            <div class="story-content">
                <h3>Our Story</h3>

                <p>
                    Welcome to our journey! We started with a passion for quality and innovation.
                    Our goal is to create meaningful experiences for our customers through
                    dedication, creativity, and excellence. Discover how our story continues to grow.
                </p>

                <a href="{{ route('about') }}" class="story-btn">Learn More</a>
            </div>

        </div>
    </section>

    <section class="featured-products-section">

        
        <div class="section-header">
            <div>
                <h2>Featured Products</h2>
                <p>Our jewelry is made by the finest artists and carefully selected to reflect your style and
                    personality</p>
            </div>

        </div>

        
        <div class="products-grid">
            @forelse (($featuredJewelleryProducts ?? collect()) as $product)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                        <a href="{{ $product['url'] }}" class="view-shop-btn">View Shop</a>
                    </div>

                    <div class="product-info">
                        <span class="category">{{ $product['category'] }}</span>
                        <h4>{{ $product['name'] }}</h4>
                        <div class="price">LKR {{ number_format((float) ($product['price'] ?? 0), 2) }}</div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column:1/-1;text-align:center;padding:24px 18px;color:#666;">
                    No jewellery sales data is available yet.
                </div>
            @endforelse

        </div>

        
        <div class="bottom-btn-wrapper">
            <a href="{{ route('jewellery') }}" class="btn">Explore More Products</a>
        </div>

    </section>

    <section class="modern-banner-section">

        <div class="banner-grid">

            @foreach (($bannerCards ?? []) as $bannerCard)
                <a href="{{ $bannerCard['url'] }}" class="modern-banner-card">
                    <div class="banner-bg" style="background-image: url('{{ $bannerCard['image'] }}');"></div>
                    <div class="banner-overlay"></div>

                    <div class="banner-content">
                        <span class="banner-subtitle">{{ $bannerCard['subtitle'] }}</span>
                        <h3>{!! $bannerCard['title'] !!}</h3>
                        <p>{{ $bannerCard['description'] }}</p>
                        <span class="banner-btn">Shop Now</span>
                    </div>
                </a>
            @endforeach

        </div>

    </section>

    <section class="featured-products-section">

        
        <div class="section-header">
            <div>
                <h2>Popular Gems</h2>
                <p>Discover our most loved and highly valued natural gemstones collection</p>
            </div>
        </div>

        
        <div class="products-grid">
            @forelse (($featuredGemProducts ?? collect()) as $product)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                        <a href="{{ $product['url'] }}" class="view-shop-btn">View Shop</a>
                    </div>

                    <div class="product-info">
                        <span class="category">{{ $product['category'] }}</span>
                        <h4>{{ $product['name'] }}</h4>
                        <div class="price">LKR {{ number_format((float) ($product['price'] ?? 0), 2) }}</div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column:1/-1;text-align:center;padding:24px 18px;color:#666;">
                    No gemstone sales data is available yet.
                </div>
            @endforelse

        </div>

        
        <div class="bottom-btn-wrapper">
            <a href="{{ route('gems') }}" class="btn">Explore Popular Gems</a>
        </div>

    </section>

    <section class="category-section">

        <div class="category-row">

            <a href="{{ route('jewellery', ['category' => 'type:ring']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji1.png') }}" alt="Rings">
                </div>
                <h4>Rings</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:necklace']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji5.png') }}" alt="Necklaces">
                </div>
                <h4>Necklaces</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:chain']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji9.png') }}" alt="Chains">
                </div>
                <h4>Chains</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:bracelet']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji2.png') }}" alt="Bracelets"
                        style="width:35px; height:35px; object-fit:contain;">
                </div>
                <h4>Bracelets</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:bangle']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji6.png') }}" alt="Bangles"
                        style="width:35px; height:35px; object-fit:contain;">
                </div>
                <h4>Bangles</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:earring']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji3.png') }}" alt="Earrings"
                        style="width:35px; height:35px; object-fit:contain;">
                </div>
                <h4>Earrings</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:pendant']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji10.png') }}" alt="Pendants">
                </div>
                <h4>Pendants</h4>
            </a>

            <a href="{{ route('jewellery', ['category' => 'type:other-jewellery']) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('images/main_website/web_ji11.png') }}" alt="Other Jewelry">
                </div>
                <h4>Other Jewelry</h4>
            </a>

        </div>

        

    </section>

    <section class="review-section">

        <div class="review-container">

            
            <div class="review-left-side slide-in-left">
                <div class="review-eyebrow" style="color:#fff; font-size:20px;">CUSTOMER REVIEWS</div>
                <h2 class="review-headline" style="color:#fff;">What our<br>clients say</h2>

                @if ($homeReviews->isNotEmpty())
                    <div class="review-happy-row">
                        <div class="review-avatars">
                            @foreach ($homeReviews->take(3) as $review)
                                <div class="review-avatar-circle" title="{{ $review['author_name'] }}">
                                    @if (!empty($review['avatar_url']))
                                        <img src="{{ $review['avatar_url'] }}" alt="{{ $review['author_name'] }}">
                                    @else
                                        <span class="review-avatar-initial">{{ $review['avatar_initial'] }}</span>
                                    @endif
                                </div>
                            @endforeach

                            @if ($homeReviewCount > $homeReviews->take(3)->count())
                                <div class="review-avatar-circle plus" style="color:#fff;">+{{ $homeReviewCount - $homeReviews->take(3)->count() }}</div>
                            @endif
                        </div>

                        <div class="review-happy-text">
                            <div class="review-big" style="color:#fff;">{{ number_format($homeHappyCustomers) }}+</div>
                            <div class="review-small" style="color:#fff;">HAPPY CUSTOMERS</div>
                        </div>
                    </div>
                @else
                    <div class="review-happy-row">
                        <div class="review-happy-text">
                            <div class="review-big" style="color:#fff;">0</div>
                            <div class="review-small" style="color:#fff;">REVIEWS YET</div>
                        </div>
                    </div>
                @endif
            </div>

            
            <div class="review-right-side">

                @if ($homeReviews->isNotEmpty())
                    <div class="review-slider home-review-slider">
                        @foreach ($homeReviews as $index => $review)
                            <div class="review-slide {{ $index === 0 ? 'active' : '' }}">
                                <div class="review-rating">
                                    <div class="review-rating-number">{{ $review['rating_label'] }}</div>
                                    <div class="review-stars-note">
                                        <div class="review-stars" aria-label="{{ $review['rating'] }} out of 5 stars">
                                            @for ($star = 1; $star <= 5; $star++)
                                                {{ $star <= $review['rating'] ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <div class="review-note">{{ number_format($homeReviewCount) }} reviews</div>
                                    </div>
                                </div>

                                <p class="review-text">“{{ $review['text'] }}”</p>

                                <div class="review-author">
                                    <div class="review-avatar-circle small">
                                        @if (!empty($review['avatar_url']))
                                            <img src="{{ $review['avatar_url'] }}" alt="{{ $review['author_name'] }}">
                                        @else
                                            <span class="review-avatar-initial">{{ $review['avatar_initial'] }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="review-author-name">{{ $review['author_name'] }}</div>
                                        <div class="review-author-role">{{ $review['author_role'] }}</div>
                                        @if (!empty($review['product_name']))
                                            <div class="review-product">{{ $review['product_name'] }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="review-dots">
                        @foreach ($homeReviews as $index => $review)
                            <span class="review-dot {{ $index === 0 ? 'active' : '' }}"></span>
                        @endforeach
                    </div>
                @else
                    <div class="review-slider home-review-slider">
                        <div class="review-slide active">
                            <div class="review-rating">
                                <div class="review-rating-number">0.0</div>
                                <div class="review-stars-note">
                                    <div class="review-stars">☆☆☆☆☆</div>
                                    <div class="review-note">No approved reviews yet</div>
                                </div>
                            </div>

                            <p class="review-text">We’re collecting customer feedback now. Once reviews are approved, they’ll appear here automatically.</p>

                            <div class="review-author">
                                <div class="review-avatar-circle small">
                                    <span class="review-avatar-initial">V</span>
                                </div>
                                <div>
                                    <div class="review-author-name">Verified Buyer</div>
                                    <div class="review-author-role">Waiting for first review</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="review-slider" style="display:none;">

                    
                    <div class="review-slide active">
                        <div class="review-rating">
                            <div class="review-rating-number">4.9</div>
                            <div class="review-stars-note">
                                <div class="review-stars">★★★★★</div>
                                <div class="review-note">4.9K reviews</div>
                            </div>
                        </div>

                        <p class="review-text">
                            “Absolutely stunning craftsmanship. The detailing and finishing
                            of the jewelry exceeded my expectations. Truly luxury quality.”
                        </p>

                        <div class="review-author">
                            <div class="review-avatar-circle small">
                                <img src="{{ asset('images/main_website/Feedback (1).jpg') }}">
                            </div>
                            <div>
                                <div class="review-author-name">Sophia Turner</div>
                                <div class="review-author-role">Verified Buyer</div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="review-slide active">
                        <div class="review-rating">
                            <div class="review-rating-number">4.9</div>
                            <div class="review-stars-note">
                                <div class="review-stars">★★★★★</div>
                                <div class="review-note">4.9K reviews</div>
                            </div>
                        </div>

                        <p class="review-text">
                            “Absolutely stunning craftsmanship. The detailing and finishing
                            of the jewelry exceeded my expectations. Truly luxury quality.”
                        </p>

                        <div class="review-author">
                            <div class="review-avatar-circle small">
                                <img src="{{ asset('images/main_website/Feedback (1).jpg') }}">
                            </div>
                            <div>
                                <div class="review-author-name">Sophia Turner</div>
                                <div class="review-author-role">Verified Buyer</div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="review-slide active">
                        <div class="review-rating">
                            <div class="review-rating-number">4.9</div>
                            <div class="review-stars-note">
                                <div class="review-stars">★★★★★</div>
                                <div class="review-note">4.9K reviews</div>
                            </div>
                        </div>

                        <p class="review-text">
                            “Absolutely stunning craftsmanship. The detailing and finishing
                            of the jewelry exceeded my expectations. Truly luxury quality.”
                        </p>

                        <div class="review-author">
                            <div class="review-avatar-circle small">
                                <img src="{{ asset('images/main_website/Feedback (1).jpg') }}">
                            </div>
                            <div>
                                <div class="review-author-name">Sophia Turner</div>
                                <div class="review-author-role">Verified Buyer</div>
                            </div>
                        </div>
                    </div>

                    

                </div>

                <div class="review-dots">
                    <span class="review-dot active"></span>
                    <span class="review-dot"></span>
                    <span class="review-dot"></span>
                </div>

            </div>

        </div>

    </section>

    <section class="services-section">

        <div class="services-header">
            <h2>Best Services</h2>
            <p>We provide premium quality customer support and luxury shopping experience</p>
        </div>

        <div class="services-container">

            <div class="services-card">
                <img src="{{ asset('images/main_website/web_s1.png') }}" class="services-icon-img">
                <div class="services-title">Express Shipping</div>
                <p class="services-text">
                    We offer same day shipping for only LKR 350.
                </p>
            </div>

            <div class="services-card">
                <img src="{{ asset('images/main_website/web_s2.png') }}" class="services-icon-img">
                <div class="services-title">Always At Your Service</div>
                <p class="services-text">
                    Our expert client care consultants are always here to help.
                </p>
            </div>

            <div class="services-card">
                <img src="{{ asset('images/main_website/web_s3.png') }}" class="services-icon-img">
                <div class="services-title">Book an Appointment</div>
                <p class="services-text">
                    We’re happy to help with in-store or virtual appointments.
                </p>
            </div>

            <div class="services-card">
                <img src="{{ asset('images/main_website/web_s4.png') }}" class="services-icon-img">
                <div class="services-title">The Iconic Blue Box</div>
                <p class="services-text">
                    Your purchase comes wrapped in our signature Blue Box packaging.
                </p>
            </div>

        </div>
    </section>

    <section class="promo-banner">

        <div class="promo-overlay"></div>

        <div class="promo-content">

            <div class="promo-subtitle">
                Crafting Excellence in Every Detail
            </div>

            <h2 class="promo-title">
                Finest Handmade Jewelry<br>
                Designed for Your Style
            </h2>

            <p class="promo-text">
                Discover our premium handcrafted jewelry collection made with precision,
                passion, and timeless elegance. Each piece is created to reflect beauty,
                quality, and luxury.
            </p>

            <div class="promo-btn-wrapper">
                <a href="{{ route('jewellery') }}" class="promo-btn">Explore Best Products</a>
            </div>
 
        </div>

    </section>

    <section class="newsletter-section" id="newsletter-section">

        <div class="newsletter-container">

            <div class="newsletter-content">
                <h2>Join Our Newsletter</h2>
                <p>
                    Subscribe to receive latest updates, exclusive offers,
                    and new collection launches.
                </p>
            </div>

            <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>

            @if (session('newsletter_success'))
                <div class="newsletter-success">{{ session('newsletter_success') }}</div>
            @endif
            @error('email')
                <div class="newsletter-error">{{ $message }}</div>
            @enderror

        </div>

    </section>

    
    <x-footer />

    <div id="loginModal" class="login-modal" aria-hidden="true">
        <div class="login-modal-card" role="dialog" aria-modal="true" aria-labelledby="loginModalTitle">
            <div class="login-modal-head">
                <h3 id="loginModalTitle">Please log in first</h3>
                <button class="login-modal-close" type="button" aria-label="Close dialog" data-login-modal-close>
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p>You can explore astrology without signing in. To continue, please sign in first.</p>
            <div class="login-modal-actions">
                <button class="btn secondary" type="button" data-login-modal-close>Cancel</button>
                <a class="btn primary" href="{{ route('signin') }}" id="loginModalLink">Sign In</a>
            </div>
        </div>
    </div>

    
    <button id="scrollTopBtn">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        const menuToggle = document.querySelector('.site-navbar-toggle');
        const navMenu = document.querySelector('.site-navbar-menu');

        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', () => {
                navMenu.classList.toggle('open');
            });
        }

        document.addEventListener("DOMContentLoaded", function () {

            const slides = document.querySelectorAll(".slide");
            const dotsContainer = document.querySelector(".slider-dots");
            let currentSlide = 0;
            let slideInterval;

            slides.forEach((_, i) => {
                const dot = document.createElement("div");
                dot.addEventListener("click", () => goToSlide(i));
                dotsContainer.appendChild(dot);
            });

            const dots = dotsContainer.querySelectorAll("div");

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove("active"));
                dots.forEach(dot => dot.classList.remove("active"));

                slides[index].classList.add("active");
                dots[index].classList.add("active");
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            function goToSlide(index) {
                currentSlide = index;
                showSlide(index);
                resetInterval();
            }

            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }

            showSlide(currentSlide);
            slideInterval = setInterval(nextSlide, 5000);
        });



        document.addEventListener("DOMContentLoaded", () => {

            const slides = document.querySelectorAll(".home-review-slider .review-slide");
            const dots = document.querySelectorAll(".home-review-slider .review-dot");

            if (!slides.length || !dots.length) return;

            let currentSlide = 0;
            const slideInterval = 5000;

            function showSlide(index) {

                slides.forEach(slide => slide.classList.remove("active"));
                dots.forEach(dot => dot.classList.remove("active"));

                if (slides[index]) {
                    slides[index].classList.add("active");
                }

                if (dots[index]) {
                    dots[index].classList.add("active");
                }

                currentSlide = index;
            }

            function nextSlide() {
                let nextIndex = (currentSlide + 1) % slides.length;
                showSlide(nextIndex);
            }

            let autoSlide = setInterval(nextSlide, slideInterval);

            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    clearInterval(autoSlide);
                    showSlide(index);
                    autoSlide = setInterval(nextSlide, slideInterval);
                });
            });

            showSlide(0);

        });

        document.addEventListener("DOMContentLoaded", () => {
            const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            if (reduceMotion) return;

            if (!document.getElementById("section-reveal-style")) {
                const style = document.createElement("style");
                style.id = "section-reveal-style";
                style.textContent = `
                    .section-reveal {
                        opacity: 0;
                        transform: translateY(28px);
                        transition: opacity 0.7s ease, transform 0.7s ease;
                        transition-delay: var(--reveal-delay, 0ms);
                        will-change: opacity, transform;
                    }
                    .section-reveal.is-visible {
                        opacity: 1;
                        transform: translateY(0);
                    }
                `;
                document.head.appendChild(style);
            }

            const targets = document.querySelectorAll("section, .footer");
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.18, rootMargin: "0px 0px -8% 0px" });

            let idx = 0;
            targets.forEach((el) => {
                if (el.classList.contains("hero")) return;
                el.classList.add("section-reveal");
                el.style.setProperty("--reveal-delay", `${(idx % 4) * 80}ms`);
                observer.observe(el);
                idx++;
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const categorySelect = document.getElementById("homeCategoryFilter");
            const subCategorySelect = document.getElementById("homeSubCategoryFilter");
            const productsGrid = document.getElementById("homeFilteredProducts");
            const emptyState = document.getElementById("homeFilterEmpty");

            if (!categorySelect || !subCategorySelect || !productsGrid || !emptyState) return;

            const jewelleryProducts = [
                { category: "Rings", subCategory: "Gold Rings", name: "Gold Ring with Emerald Detail", price: "963.54$", image: "{{ asset('images/main_website/fp_1.jpg') }}", link: "{{ route('jewellery') }}#rings" },
                { category: "Rings", subCategory: "Diamond Rings", name: "Classic Diamond Ring", price: "899.00$", image: "{{ asset('images/main_website/fp_2.jpg') }}", link: "{{ route('jewellery') }}#rings" },
                { category: "Rings", subCategory: "Statement Rings", name: "Royal Statement Ring", price: "775.00$", image: "{{ asset('images/main_website/fp_3.jpg') }}", link: "{{ route('jewellery') }}#rings" },

                { category: "Necklaces", subCategory: "Gold Necklaces", name: "Heritage Gold Necklace", price: "1,250.00$", image: "{{ asset('images/main_website/web_ji5.png') }}", link: "{{ route('jewellery') }}#necklaces" },
                { category: "Necklaces", subCategory: "Pearl Necklaces", name: "Pearl Grace Necklace", price: "645.00$", image: "{{ asset('images/main_website/fp_6.jpeg') }}", link: "{{ route('jewellery') }}#necklaces" },
                { category: "Necklaces", subCategory: "Bridal Necklaces", name: "Bridal Temple Necklace", price: "1,540.00$", image: "{{ asset('images/main_website/web_c1.jfif') }}", link: "{{ route('jewellery') }}#necklaces" },

                { category: "Chains", subCategory: "Box Chains", name: "Fine Box Chain", price: "290.00$", image: "{{ asset('images/main_website/web_ji9.png') }}", link: "{{ route('jewellery') }}#chains" },
                { category: "Chains", subCategory: "Rope Chains", name: "Twist Rope Chain", price: "335.00$", image: "{{ asset('images/main_website/web_c2.png') }}", link: "{{ route('jewellery') }}#chains" },

                { category: "Bracelets", subCategory: "Gold Bracelets", name: "Royal Gold Bracelet", price: "699.00$", image: "{{ asset('images/main_website/fp_4.jpg') }}", link: "{{ route('jewellery') }}#bracelets" },
                { category: "Bracelets", subCategory: "Tennis Bracelets", name: "Diamond Tennis Bracelet", price: "1,120.00$", image: "{{ asset('images/main_website/fp_7.jpg') }}", link: "{{ route('jewellery') }}#bracelets" },

                { category: "Bangles", subCategory: "Gold Bangles", name: "Traditional Gold Bangle", price: "860.00$", image: "{{ asset('images/main_website/web_ji6.png') }}", link: "{{ route('jewellery') }}#bangles" },
                { category: "Bangles", subCategory: "Bridal Bangles", name: "Bridal Stone Bangle Set", price: "1,030.00$", image: "{{ asset('images/main_website/fp_8.jpg') }}", link: "{{ route('jewellery') }}#bangles" },

                { category: "Earrings", subCategory: "Stud Earrings", name: "Round Stud Earrings", price: "210.00$", image: "{{ asset('images/main_website/web_ji3.png') }}", link: "{{ route('jewellery') }}#earrings" },
                { category: "Earrings", subCategory: "Drop Earrings", name: "Elegant Drop Earrings", price: "375.00$", image: "{{ asset('images/main_website/web_s1.png') }}", link: "{{ route('jewellery') }}#earrings" },

                { category: "Pendants", subCategory: "Gemstone Pendants", name: "Sapphire Pendant", price: "480.00$", image: "{{ asset('images/main_website/web_ji10.png') }}", link: "{{ route('jewellery') }}#pendants" },
                { category: "Pendants", subCategory: "Heart Pendants", name: "Heart Gold Pendant", price: "325.00$", image: "{{ asset('images/main_website/web_s2.png') }}", link: "{{ route('jewellery') }}#pendants" },

                { category: "Other Jewelry", subCategory: "Gift Sets", name: "Luxury Gift Set", price: "540.00$", image: "{{ asset('images/main_website/web_ji11.png') }}", link: "{{ route('jewellery') }}#other-jewelry" },
                { category: "Other Jewelry", subCategory: "Wedding Jewelry", name: "Wedding Special Set", price: "1,780.00$", image: "{{ asset('images/main_website/web_s3.png') }}", link: "{{ route('jewellery') }}#other-jewelry" }
            ];

            const uniqueValues = (items) => [...new Set(items)];

            const renderProductCards = (items) => {
                productsGrid.innerHTML = items.map((product) => `
                    <a href="${product.link}" class="filter-product-card">
                        <div class="filter-product-media">
                            <img src="${product.image}" alt="${product.name}">
                        </div>
                        <div class="filter-product-body">
                            <p class="filter-product-meta">${product.subCategory} | ${product.category}</p>
                            <h4 class="filter-product-name">${product.name}</h4>
                            <p class="filter-product-price">${product.price}</p>
                        </div>
                    </a>
                `).join("");

                emptyState.style.display = items.length ? "none" : "block";
            };

            const updateSubCategories = () => {
                const selectedCategory = categorySelect.value;
                const subCategories = selectedCategory === "all"
                    ? uniqueValues(jewelleryProducts.map((product) => product.subCategory))
                    : uniqueValues(
                        jewelleryProducts
                            .filter((product) => product.category === selectedCategory)
                            .map((product) => product.subCategory)
                    );

                subCategorySelect.innerHTML = '<option value="all">All Sub Categories</option>';
                subCategories.forEach((subCategory) => {
                    const option = document.createElement("option");
                    option.value = subCategory;
                    option.textContent = subCategory;
                    subCategorySelect.appendChild(option);
                });
            };

            const applyFilter = () => {
                const selectedCategory = categorySelect.value;
                const selectedSubCategory = subCategorySelect.value;

                const filtered = jewelleryProducts.filter((product) => {
                    const categoryMatch = selectedCategory === "all" || product.category === selectedCategory;
                    const subCategoryMatch = selectedSubCategory === "all" || product.subCategory === selectedSubCategory;
                    return categoryMatch && subCategoryMatch;
                });

                renderProductCards(filtered);
            };

            const categories = uniqueValues(jewelleryProducts.map((product) => product.category));
            categories.forEach((category) => {
                const option = document.createElement("option");
                option.value = category;
                option.textContent = category;
                categorySelect.appendChild(option);
            });

            categorySelect.addEventListener("change", () => {
                updateSubCategories();
                applyFilter();
            });

            subCategorySelect.addEventListener("change", applyFilter);

            updateSubCategories();
            applyFilter();
        });

        const loginModal = document.getElementById("loginModal");
        const loginModalLink = document.getElementById("loginModalLink");

        function openLoginModal(loginUrl) {
            if (!loginModal || !loginModalLink) return;
            loginModalLink.href = loginUrl || "{{ route('signin') }}";
            loginModal.classList.add("open");
            loginModal.setAttribute("aria-hidden", "false");
        }

        function closeLoginModal() {
            if (!loginModal) return;
            loginModal.classList.remove("open");
            loginModal.setAttribute("aria-hidden", "true");
        }

        document.querySelectorAll("[data-login-modal-close]").forEach((button) => {
            button.addEventListener("click", closeLoginModal);
        });

        loginModal?.addEventListener("click", (event) => {
            if (event.target === loginModal) {
                closeLoginModal();
            }
        });

        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeLoginModal();
            }
        });

        document.querySelectorAll(".js-astro-gate").forEach((button) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                openLoginModal(button.dataset.loginUrl || "{{ route('signin') }}");
            });
        });

        const scrollBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function () {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollBtn.style.display = "flex";
            } else {
                scrollBtn.style.display = "none";
            }
        };

        scrollBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

    <x-scroll-animations />
</body>

</html>






