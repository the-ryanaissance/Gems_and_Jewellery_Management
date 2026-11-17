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
            font-size: 1.3rem;
            font-weight: 400;
            letter-spacing: 1px;
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

        
        @media(max-width: 768px) {
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
        }

        .gemstones-section {
            background: #f9f7f1;
            
            padding: 60px 20px;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        .gemstones-section .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .gemstones-section h2 {
            color: #bfa16a;
            
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .gemstones-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
        }

        .gem-details-anim {
            opacity: 0;
            transform: translateY(40px);
        }

        .gem-details-anim.is-visible {
            animation: gemDetailsUp 0.8s ease forwards;
        }

        @keyframes gemDetailsUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        
        .mining-banner {
            position: relative;
            width: 100%;
            min-height: 80vh;
            
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset('images/main_website/web_gemstory1.jpg') }}') center/cover no-repeat;
            
            overflow: hidden;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        
        .mining-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            
            z-index: 1;
        }

        
        .mining-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 20px;
            max-width: 800px;
            animation: fadeInUp 1s ease forwards;
        }

        
        .banner-small {
            display: inline-block;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #bfa16a;
            
            margin-bottom: 10px;
        }

        
        .mining-banner-content h2 {
            font-size: 2.8rem;
            font-weight: 700;
            margin: 15px 0;
            line-height: 1.2;
        }

        
        .mining-banner-content p {
            font-size: 1.1rem;
            color: #f0f0f0;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        
        .banner-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 28px;
            font-size: 1rem;
            background: #bfa16a;
            
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .banner-btn i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        
        .banner-btn:hover {
            background: #fff;
            color: #000;
            transform: translateY(-3px);
        }

        .banner-btn:hover i {
            transform: translateX(5px);
        }

        
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        @media (max-width: 768px) {
            .mining-banner-content h2 {
                font-size: 2rem;
            }

            .mining-banner-content p {
                font-size: 1rem;
            }

            .banner-btn {
                padding: 10px 22px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .mining-banner-content h2 {
                font-size: 1.6rem;
            }

            .banner-small {
                font-size: 0.8rem;
            }
        }



        
        #gem-types {
            padding: 60px 20px;
            background: #f9f7f1;
            font-family: 'Arial', sans-serif;
        }

        .gem-types-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 40px;
        }

        .gem-types-image {
            flex: 1;
            min-width: 300px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .gem-types-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gem-types-image:hover img {
            transform: scale(1.05);
        }

        .gem-types-content {
            flex: 1;
            min-width: 300px;
        }

        .gem-types-content h2 {
            color: #bfa16a;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .gem-types-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 20px;
        }

        .learn-more-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 28px;
            font-size: 1rem;
            background: #bfa16a;
            color: #fff;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .learn-more-btn i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .learn-more-btn:hover {
            background: #fff;
            color: #000;
        }

        .learn-more-btn:hover i {
            transform: translateX(5px);
        }

        
        @media (max-width: 768px) {
            .gem-types-container {
                flex-direction: column;
            }

            .gem-types-image,
            .gem-types-content {
                min-width: 100%;
            }

            .gem-types-content h2 {
                font-size: 1.8rem;
            }

            .gem-types-content p {
                font-size: 1rem;
            }
        }


        
        .gem-shapes {
            padding: 60px 20px;
            background: #fdf8f2;
        }

        .gem-shapes-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            gap: 40px;
        }

        
        .gem-shapes-text {
            flex: 1;
            min-width: 280px;
        }

        .gem-shapes-text h2 {
            font-size: 2.5rem;
            color: #bfa16a;
            margin-bottom: 20px;
        }

        .gem-shapes-text p {
            font-size: 1rem;
            color: #333;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .gem-shapes-btn {
            display: inline-block;
            background: #bfa16a;
            color: #fff;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: 0.3s;
        }

        .gem-shapes-btn:hover {
            background: #a88c50;
        }

        
        .gem-shapes-image {
            flex: 1;
            min-width: 280px;
        }

        .gem-shapes-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        
        @media (max-width: 992px) {
            .gem-shapes-container {
                flex-direction: column;
            }

            .gem-shapes-image {
                order: -1;
                
            }
        }

        
        .colors-banner {
            position: relative;
            background: url('{{ asset('images/main_website/web_colur1.png') }}') center/cover no-repeat;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        
        .colors-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        
        .colors-banner-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            text-align: center;
            max-width: 800px;
            padding: 20px;
        }

        
        .colors-banner-content .banner-small {
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ffd580;
        }

        
        .colors-banner-content h2 {
            font-size: 42px;
            margin: 15px 0;
            font-weight: 600;
        }

        
        .colors-banner-content p {
            font-size: 18px;
            line-height: 1.6;
        }

        
        .colors-banner-content .banner-btn {
            display: inline-block;
            margin-top: 20px;
            background: #bfa16a;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        
        .colors-banner-content .banner-btn:hover {
            background: #a68d55;
            transform: translateY(-2px);
        }


        .colors-container {
            max-width: 1100px;
            margin: auto;
        }

        .colors-main-title {
            text-align: center;
            font-size: 38px;
            color: #bfa16a;
            margin-bottom: 20px;
        }

        .colors-main-desc {
            text-align: center;
            max-width: 850px;
            margin: auto;
            font-size: 18px;
            color: #444;
            line-height: 1.7;
            margin-bottom: 60px;
        }

        .color-row {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 60px;
            flex-wrap: wrap;
        }

        .color-row.reverse {
            flex-direction: row-reverse;
        }

        .color-image {
            flex: 1;
            min-width: 280px;
        }

        .color-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .color-content {
            flex: 1;
            min-width: 280px;
        }

        .color-content h3 {
            font-size: 26px;
            color: #bfa16a;
            margin-bottom: 15px;
        }

        .color-desc {
            font-size: 16px;
            color: #444;
            margin-bottom: 15px;
        }

        .color-content ul {
            padding-left: 18px;
            line-height: 1.7;
            color: #333;
        }

        .back-btn-wrap {
            text-align: center;
            margin-top: 50px;
        }

        #backColors {
            background: #bfa16a;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 40px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        #backColors:hover {
            background: #a88c55;
        }

        

        .birth-gems {
            padding: 80px 20px;
            background: #fff;
        }

        .birth-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        
        .birth-text {
            flex: 1;
            min-width: 280px;
        }

        .birth-text h2 {
            font-size: 2.5rem;
            color: #bfa16a;
            margin-bottom: 20px;
        }

        .birth-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 25px;
        }

        
        .birth-btn {
            display: inline-block;
            background: #bfa16a;
            color: #fff;
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .birth-btn:hover {
            background: #a68b58;
        }

        
        .birth-image {
            flex: 1;
            min-width: 280px;
        }

        .birth-image img {
            width: 100%;

            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        
        @media(max-width:768px) {

            .birth-container {
                flex-direction: column;
                text-align: center;
            }

        }

        .birth-gem-row {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 70px;
            flex-wrap: wrap;
        }

        .birth-gem-row.reverse {
            flex-direction: row-reverse;
        }

        .birth-gem-img {
            flex: 1;
            min-width: 280px;
        }

        .birth-gem-img img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .birth-gem-text {
            flex: 1;
            min-width: 280px;
        }

        .birth-gem-text h3 {
            color: #bfa16a;
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        .birth-gem-text p {
            color: #555;
            line-height: 1.8;
        }


        

        .ascendant-gem-section {
            padding: 80px 20px;
            background: #ffffff;
        }

        .ascendant-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        

        .ascendant-image {
            flex: 1;
            min-width: 280px;
        }

        .ascendant-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        

        .ascendant-content {
            flex: 1;
            min-width: 280px;
        }

        .asc-small-title {
            color: #bfa16a;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 14px;
        }

        .ascendant-content h2 {
            font-size: 36px;
            margin: 15px 0;
            color: #222;
        }

        .ascendant-content p {
            font-size: 17px;
            line-height: 1.7;
            color: #444;
            max-width: 520px;
        }

        

        .asc-btn {
            display: inline-block;
            margin-top: 25px;
            background: #bfa16a;
            color: #fff;
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .asc-btn:hover {
            background: #a88c55;
        }

        
        #ascendant-details {
            display: none;
        }

        .ascendant-details {
            padding: 90px 18px;
            background: #fff8f0;
        }

        .asc-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .asc-head {
            text-align: center;
            margin-bottom: 28px;
        }

        .asc-title {
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: #bfa16a;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .asc-subtitle {
            max-width: 1000px;
            margin: 0 auto;
            color: #555;
            line-height: 1.9;
            font-size: 1.08rem;
        }

        .asc-main-image {
    width: 400px;          
    margin: 34px auto 55px; 
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.16);
}

.asc-main-image img {
    width: 100%;
    height: 350px;  
    object-fit: cover;
    display: block;
}

        .asc-intro-text {
            max-width: 950px;
            margin: -18px auto 34px;
            text-align: center;
            color: #4f4f4f;
            line-height: 1.8;
            font-size: 1rem;
        }

        .asc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .asc-card {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(191, 161, 106, 0.18);
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .asc-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.12);
        }

        .asc-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .asc-sign {
            font-weight: 800;
            color: #2a2a2a;
            font-size: 1.05rem;
        }

        .asc-gem {
            font-weight: 700;
            color: #bfa16a;
            background: rgba(191, 161, 106, 0.12);
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.9rem;
        }

        .asc-card-images {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .asc-card-images img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .asc-card-desc {
            margin-top: 12px;
            color: #555;
            line-height: 1.7;
            font-size: 0.93rem;
        }

        
        .asc-actions {
            text-align: center;
            margin-top: 45px;
        }

        .asc-back-btn {
            background: #bfa16a;
            color: #fff;
            padding: 12px 34px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .asc-back-btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        
        @media (max-width: 980px) {
            .asc-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .asc-main-image img {
                height: 300px;
            }
        }

        @media (max-width: 560px) {
            .asc-grid {
                grid-template-columns: 1fr;
            }

            .asc-card-images img {
                height: 140px;
            }

            .asc-main-image img {
                height: 230px;
            }
        }

        
        .gem-insight-banner {
            position: relative;
            background: url('{{ asset('images/main_website/web_planet0.jpg') }}') center/cover no-repeat;
            min-height: 470px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 40px 20px;
        }

        .gem-insight-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.52);
            z-index: 1;
        }

        .gem-insight-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
            text-align: center;
            color: #fff;
        }

        .gem-insight-small {
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ffd580;
        }

        .gem-insight-content h2 {
            font-size: clamp(2rem, 3.4vw, 3rem);
            margin: 14px 0 14px;
            font-weight: 700;
        }

        .gem-insight-content p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #f0f0f0;
        }

        .gem-insight-btn {
            display: inline-block;
            margin-top: 22px;
            background: #bfa16a;
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 40px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .gem-insight-btn:hover {
            background: #a88c55;
            transform: translateY(-2px);
        }

        #gem-insight-details {
            display: none;
            padding: 90px 18px;
            background: #fff8f0;
        }

        .insight-container {
            max-width: 1180px;
            margin: 0 auto;
        }

        .insight-title {
            text-align: center;
            font-size: clamp(2rem, 3vw, 2.7rem);
            color: #bfa16a;
            margin-bottom: 14px;
        }

        .insight-subtitle {
            max-width: 920px;
            margin: 0 auto 34px;
            text-align: center;
            color: #555;
            line-height: 1.9;
        }

        .insight-main-image {
            width: min(560px, 100%);
            margin: 0 auto 24px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.14);
        }

        .insight-main-image img {
            width: 100%;
            height: 330px;
            object-fit: cover;
            display: block;
        }

        .insight-intro {
            max-width: 900px;
            margin: 0 auto 36px;
            text-align: center;
            color: #555;
            line-height: 1.8;
            font-size: 1rem;
        }

        .insight-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .insight-card {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(191, 161, 106, 0.2);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .insight-card-images {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding: 14px 14px 0;
        }

        .insight-card-images img {
            width: 100%;
            height: 145px;
            object-fit: cover;
            display: block;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .insight-card-body {
            padding: 16px 18px 18px;
        }

        .insight-card-body h3 {
            color: #bfa16a;
            margin-bottom: 8px;
            font-size: 1.18rem;
        }

        .insight-card-body p {
            color: #555;
            line-height: 1.75;
            font-size: 0.96rem;
        }

        .insight-actions {
            text-align: center;
            margin-top: 44px;
        }

        #backGemInsight {
            background: #bfa16a;
            color: #fff;
            padding: 12px 32px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
        }

        #backGemInsight:hover {
            background: #a88c55;
        }

        @media (max-width: 860px) {
            .insight-grid {
                grid-template-columns: 1fr;
            }

            .insight-main-image img {
                height: 250px;
            }
        }

        
        .navaratna-ring-section {
            position: relative;
            padding: 95px 20px;
            background: radial-gradient(circle at 15% 20%, #f8ecd5 0%, #fff8f0 40%, #f5efe6 100%);
            overflow: hidden;
        }

        .navaratna-ring-section::before,
        .navaratna-ring-section::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(191, 161, 106, 0.14);
            filter: blur(2px);
            z-index: 0;
        }

        .navaratna-ring-section::before {
            top: -70px;
            right: -50px;
        }

        .navaratna-ring-section::after {
            bottom: -95px;
            left: -85px;
        }

        .navaratna-ring-container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 36px;
            align-items: center;
        }

        .navaratna-content .tag {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(191, 161, 106, 0.18);
            color: #8a6f3f;
            font-size: 0.82rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .navaratna-title {
            font-size: clamp(2rem, 4vw, 3.4rem);
            line-height: 1.08;
            color: #2e2618;
            margin-bottom: 16px;
            font-weight: 800;
        }

        .navaratna-title span {
            display: inline-block;
            color: #bfa16a;
        }

        .navaratna-desc {
            color: #51493b;
            line-height: 1.88;
            font-size: 1rem;
            max-width: 640px;
            margin-bottom: 24px;
        }

        .navaratna-points {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .navaratna-points span {
            background: #fff;
            border: 1px solid rgba(191, 161, 106, 0.32);
            color: #6f5b35;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .navaratna-btn {
            display: inline-block;
            margin-top: 22px;
            background: #bfa16a;
            color: #fff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 999px;
            font-weight: 700;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .navaratna-btn:hover {
            transform: translateY(-2px);
            background: #a88c55;
        }

        .navaratna-visual {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(191, 161, 106, 0.26);
            border-radius: 22px;
            padding: 16px;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.1);
        }

        .navaratna-visual img {
            width: 100%;
            border-radius: 16px;
            display: block;
            max-height: 430px;
            object-fit: cover;
        }

        @media (max-width: 980px) {
            .navaratna-ring-container {
                grid-template-columns: 1fr;
            }

            .navaratna-title {
                font-size: clamp(1.9rem, 8vw, 2.8rem);
            }
        }

        
#navaratna-details { display: none; }

.navaratna-details-wrap{
  max-width: 1200px;
  margin: 0 auto;
  padding: 90px 18px;
  background: #fff8f0;
}

.navaratna-d-title{
  text-align: center;
  font-size: clamp(2rem, 3vw, 2.8rem);
  font-weight: 900;
  color:#bfa16a;
  margin: 0 0 14px;
  letter-spacing: .3px;
}

.navaratna-d-sub{
  text-align: center;
  max-width: 980px;
  margin: 0 auto 26px;
  color:#555;
  line-height: 1.9;
  font-size: 1.08rem;
}


.navaratna-d-main{
  max-width: 400px;
  width: 100%;
  margin: 18px auto 28px;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 12px 35px rgba(0,0,0,0.14);
}

.navaratna-d-main img{
  width: 100%;
  height: 260px;
  object-fit: cover;
  display:block;
}

.navaratna-d-note,
.navaratna-mid-note,
.navaratna-end-note{
  max-width: 1100px;
  margin: 18px auto;
  text-align: center;
  color:#444;
  line-height: 1.9;
  font-size: 1.05rem;
}


.navaratna-split{
  display:flex;
  gap: 26px;
  align-items:center;
  margin: 35px 0;
  padding: 18px;
  border-radius: 18px;
  background: rgba(255,255,255,0.75);
  border: 1px solid rgba(191,161,106,0.18);
  box-shadow: 0 10px 28px rgba(0,0,0,0.07);
}

.navaratna-split.reverse{
  flex-direction: row-reverse;
}

.navaratna-split-img{
  flex: 1;
  min-width: 260px;
}

.navaratna-split-img img{
  width:100%;
  height: 280px;
  border-radius: 16px;
  object-fit: cover;
  display:block;
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.navaratna-split-text{
  flex: 1.1;
  min-width: 260px;
}

.navaratna-split-text h3{
  margin: 0 0 10px;
  color:#bfa16a;
  font-size: 1.35rem;
  font-weight: 800;
}

.navaratna-split-text p{
  margin: 0 0 12px;
  color:#444;
  line-height: 1.8;
}

.navaratna-tags{
  display:flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 12px;
}

.navaratna-tags span{
  background: rgba(191,161,106,0.14);
  color:#bfa16a;
  font-weight: 700;
  padding: 7px 12px;
  border-radius: 999px;
  font-size: 0.9rem;
}

.navaratna-points{
  margin: 10px 0 0;
  padding-left: 18px;
  color:#333;
  line-height: 1.9;
}


.navaratna-d-actions{
  text-align:center;
  margin-top: 26px;
}

#backNavaratna{
  background:#bfa16a;
  color:#fff;
  padding: 12px 34px;
  border:none;
  border-radius: 999px;
  cursor:pointer;
  font-weight: 800;
  letter-spacing: .2px;
  box-shadow: 0 12px 25px rgba(191,161,106,0.25);
  transition: transform .2s ease, opacity .2s ease;
}

#backNavaratna:hover{
  transform: translateY(-2px);
  opacity: 0.95;
}


@media (max-width: 980px){
  .navaratna-split{
    flex-direction: column;
  }
  .navaratna-split.reverse{
    flex-direction: column;
  }
  .navaratna-split-img img{
    height: 240px;
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

<body class="story-page gem-story-page">

    <x-navbar />

    
    <section id="about-header" class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Gems & Jewellery</h1>
            <p>Explore the Natural World of Precious Gems</p>
        </div>
    </section>

    <section class="gemstones-section">
        <div class="container">
            <h2>Sri Lanka: The Treasure Island of Gemstones</h2>
            <p>
                For centuries, Sri Lanka has been celebrated as a treasure island for its extraordinary gemstones,
                especially from the renowned gem city of Ratnapura.
                The gem industry blends history, tradition, and skilled craftsmanship, transforming natural minerals
                into symbols of beauty and value.
                In astrology, gemstones are believed to influence energy, luck, and personal harmony.
                The industry offers a wide variety of gem types, including Blue Sapphire, Ruby, and Emerald, found in
                vibrant colors such as blue, red, green, yellow, and pink.
                Gems are carefully cut into shapes like oval, round, cushion, and emerald cuts, enhancing their
                brilliance and market value worldwide.
            </p>
        </div>
    </section>

    <section class="mining-banner">

        <div class="mining-overlay"></div>

        <div class="mining-banner-content">

            <span class="banner-small">Sri Lankan Heritage</span>

            <h2>Discover Gem Mining Tradition in Sri Lanka</h2>

            <p>
                Experience the ancient and ethical gemstone mining culture of Sri Lanka,
                where nature and craftsmanship meet to create world-class gemstones.
            </p>

            <a href="javascript:void(0);" class="banner-btn" id="learnMoreBtn">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
            </a>

        </div>

    </section>

    
    <section id="gem-details" style="display: none; padding: 60px 20px; background: #fff8f0;">
        <div class="container gem-details-anim" style="max-width: 1000px; margin: 0 auto;">

            <h2 style="text-align: center; color: #bfa16a; font-size: 2.5rem; margin-bottom: 40px;">Gem Mining in Sri
                Lanka</h2>

            
            <p style="font-size: 1.1rem; line-height: 1.8; color: #333; margin-bottom: 30px;">
                Gem mining is one of the oldest and most respected traditional industries in Sri Lanka, particularly in
                the historic gem-producing region of Ratnapura, famously known as the “City of Gems.” For centuries,
                this region has supplied precious stones to royal families, traders, and collectors around the world.
                The process of discovering and transforming these natural treasures involves careful planning, skilled
                labor, and time-honored techniques passed down through generations.
            </p>

            
            <div style="margin: 30px 0; border-radius: 15px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                <img src="{{ asset('images/main_website/web_gemstory2.jpg') }}" alt="Gem Mining"
                    style="width: 100%; height: auto; object-fit: cover;">
            </div>

            
            <p style="font-size: 1rem; line-height: 1.7; margin-bottom: 30px;">
                The journey begins with selecting suitable land believed to contain gem deposits. Experienced miners
                study soil structure, riverbeds, and historical mining records to identify promising locations.
                Geological signs such as specific gravel layers and sediment patterns help indicate the presence of
                gemstones.
            </p>

            
            <div style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex: 1; min-width: 280px; order: 2;">
                    <img src="{{ asset('images/main_website/web_gemstory3.jfif') }}" alt="Mining Tools"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                </div>
                <div style="flex: 1; min-width: 280px; order: 1;">
                    <p style="font-size: 1rem; line-height: 1.7;">
                        Before excavation begins, miners must obtain legal permission from the National Gem and
                        Jewellery Authority (NGJA). This ensures that mining activities follow proper regulations,
                        environmental guidelines, and safety standards. Once approval is granted, miners begin digging
                        vertical pits, sometimes over 50 feet deep.
                    </p>
                </div>
            </div>

            
            <p style="font-size: 1rem; line-height: 1.7; margin-bottom: 30px;">
                The miners reach the gem-bearing layer, locally known as “illam,” which contains a mixture of gravel,
                clay, and sand. This layer is carefully removed and transported to the surface using traditional buckets
                and pulleys.
            </p>

            
            <div style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex: 1; min-width: 280px;">
                    <img src="{{ asset('images/main_website/web_gemstory4.jpg') }}" alt="Gemstones Sorting"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                </div>
                <div style="flex: 1; min-width: 280px;">
                    <p style="font-size: 1rem; line-height: 1.7;">
                        After washing, experienced sorters examine the remaining stones by hand. Identifying rough
                        gemstones requires trained eyes, as uncut gems often appear dull. Among the most commonly found
                        gems in Sri Lanka are Blue Sapphire, Ruby, and Cat's Eye, along with many other semi-precious
                        varieties.
                    </p>
                </div>
            </div>

            
            <p style="font-size: 1rem; line-height: 1.7; margin-bottom: 30px;">
                Once valuable stones are identified, they are cleaned, cut, and polished by skilled craftsmen. Proper
                cutting enhances each gem’s brilliance, color, and clarity. The finished gemstones are evaluated for
                quality, graded, and certified before being sold locally or exported internationally. Today, Sri Lanka
                continues to blend traditional mining with modern standards, preserving its rich heritage while
                supplying some of the world’s finest gems.
            </p>


            
            <div class="details-content-modern"
                style="display: grid; grid-template-columns: repeat(auto-fit,minmax(280px,1fr)); gap: 25px; margin-bottom: 50px;">
                <div
                    style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <h4 style="color: #bfa16a; margin-bottom: 15px;">Brilliance & Beauty</h4>
                    <p>Every gem is carefully cut and polished to reveal its natural colors and brilliance, making it
                        suitable for international markets.</p>
                </div>
                <div
                    style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <h4 style="color: #bfa16a; margin-bottom: 15px;">Astrological Value</h4>
                    <p>Gemstones are believed to influence energy, luck, and personal harmony, giving them cultural and
                        spiritual significance.</p>
                </div>
                <div
                    style="background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <h4 style="color: #bfa16a; margin-bottom: 15px;">Sustainable Mining</h4>
                    <p>Modern mining practices focus on minimizing environmental impact while maintaining traditional
                        techniques.</p>
                </div>
            </div>

            
            <div style="text-align: center; margin-top: 50px;">


                <button id="backToStory"
                    style="background:#bfa16a; color:#fff; padding:12px 30px; border:none; border-radius:40px; cursor:pointer;">
                    Back to story
                </button>

            </div>
        </div>
    </section>

    
    <section id="gem-types">
        <div class="gem-types-container">
            <div class="gem-types-image">
                <img src="{{ asset('images/main_website/web_gemstory5.png') }}" alt="Types of Gems">
            </div>

            <div class="gem-types-content">
                <h2>Types of Gems in Sri Lanka</h2>
                <p>
                    Sri Lanka is famous for its wide variety of gemstones. From the deep blue of Sapphires to the fiery
                    red of Rubies
                    and the enchanting green of Emeralds, each gem tells a story of nature’s brilliance. Other popular
                    gems include
                    Cat’s Eye, Alexandrite, Garnet, and Amethyst. These gemstones are prized for their beauty, rarity,
                    and astrological significance.
                </p>
                <a href="javascript:void(0);" class="learn-more-btn" id="loadGemTypes">
                    Learn More
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    
    <section id="gem-types-details" style="display:none; padding:80px 20px; background:#fff8f0;">
        <div style="max-width:1200px; margin:auto;">

            <h2 style="text-align:center; font-size:2.6rem; color:#bfa16a; margin-bottom:20px;">
                Types of Gems
            </h2>

            <p
                style="text-align:center; max-width:900px; margin:auto; font-size:1.05rem; line-height:1.8; color:#555; margin-bottom:60px;">
                Sri Lanka is renowned as one of the world's most significant sources of precious gemstones.
                From vibrant sapphires to mystical cat’s eye stones, the island produces a remarkable variety
                of gems prized for their beauty, rarity, and symbolism. These gemstones are widely used in
                fine jewelry and have been treasured for centuries by collectors, royalty, and gem enthusiasts.
                Below are some of the most admired gemstones found in Sri Lanka and around the world.
            </p>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem1.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Alexandrite</h3>
                    <p>
                        Alexandrite is one of the rarest and most fascinating gemstones in the world, famous for its
                        unique color-changing property. In natural daylight, it appears green or bluish-green, while
                        under artificial light, it shifts to red or purplish-red. This remarkable optical phenomenon,
                        combined with its rarity, makes it highly valuable among collectors. Alexandrite symbolizes
                        balance, transformation, and good fortune. It is primarily used in fine jewelry such as rings
                        and pendants, where its mystical charm can be showcased. Its brilliance and versatility make it
                        a timeless choice for those seeking both beauty and rarity.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_gem2.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Amethyst</h3>
                    <p>
                        Amethyst is a stunning purple variety of quartz, admired for its vibrant violet hues and natural
                        clarity. Historically, it has been prized by royalty and spiritual practitioners for its calming
                        and protective properties. Known as a stone of peace and clarity, amethyst is believed to
                        promote emotional balance and mental focus. It is widely used in rings, necklaces, and
                        decorative carvings. Its durability and alluring color make it suitable for daily wear, while
                        its spiritual significance adds a meaningful layer, making it one of the most cherished and
                        versatile gemstones globally.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem3.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Diamond</h3>
                    <p>
                        Diamond is the hardest known natural gemstone, formed deep within the Earth under immense heat
                        and pressure over millions of years. Its unmatched brilliance, fire, and clarity make it the
                        most sought-after gemstone in the world. Diamonds symbolize love, strength, and eternal
                        commitment, making them the most popular choice for engagement rings and luxury jewelry.
                        Available in a range of colors from transparent to rare fancy hues, each diamond is unique. Its
                        exceptional hardness and enduring beauty ensure it remains a timeless treasure, combining both
                        aesthetic elegance and symbolic significance.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_gem4.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Garnet</h3>
                    <p>
                        Garnet is a versatile gemstone known for its wide range of colors, including deep red, orange,
                        green, and rare blues. The deep red variety is the most common and has been treasured for
                        centuries for its fiery brilliance. Garnet symbolizes passion, protection, and energy, and is
                        believed to bring strength and confidence to its wearer. Its durability and affordability make
                        it popular for everyday jewelry. Garnet is often used in rings, necklaces, and earrings, and is
                        valued both for its aesthetic appeal and its historical and cultural significance across many
                        civilizations.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem5.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Jade</h3>
                    <p>
                        Jade, encompassing both jadeite and nephrite, is a gemstone celebrated for its smooth texture,
                        vibrant green hues, and cultural significance. Traditionally revered in Asian cultures, jade
                        represents purity, harmony, and protection. It has been used for thousands of years in carvings,
                        ornaments, and jewelry. In addition to its spiritual significance, jade is valued for its
                        durability and aesthetic beauty. The stone’s smooth surface and subtle glow make it a timeless
                        choice for rings, bangles, pendants, and decorative objects. Its symbolism and elegance continue
                        to make jade one of the most meaningful gemstones in history.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web-gem6.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Ruby</h3>
                    <p>
                        Ruby is a precious red gemstone from the corundum family, renowned for its vibrant color,
                        hardness, and brilliance. Often referred to as the “king of gemstones,” ruby has been highly
                        prized by royalty and collectors for centuries. Symbolizing passion, courage, and vitality, it
                        is believed to bring confidence and protection to its wearer. Rubies are primarily used in
                        rings, necklaces, and high-end jewelry designs, where their fiery red hue and clarity can be
                        showcased. Their rarity and historical significance make rubies both an investment and a symbol
                        of timeless beauty.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem6.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Blue Sapphire</h3>
                    <p>
                        Blue Sapphire is a stunning gemstone known for its deep royal blue color, durability, and
                        brilliance. A member of the corundum family, it has been associated with wisdom, loyalty, and
                        protection for centuries. Historically, blue sapphires were worn by kings and clergy as symbols
                        of power and truth. Their hardness makes them ideal for rings, earrings, and necklaces. Beyond
                        their beauty, blue sapphires are also valued in astrology and spiritual practices, believed to
                        bring clarity, prosperity, and positive energy. The gemstone’s elegance and versatility make it
                        one of the most admired gems worldwide.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_gem7.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Yellow Sapphire</h3>
                    <p>Yellow Sapphire is a bright and vibrant corundum gemstone, renowned for its golden-yellow color
                        and exceptional clarity. Often used in astrology, it is believed to attract wealth, prosperity,
                        and wisdom while providing protection and positive energy to its wearer. Historically, yellow
                        sapphires have been treasured for their beauty and symbolic significance. Their durability makes
                        them suitable for rings, pendants, and other fine jewelry pieces. The warm, cheerful hue of
                        yellow sapphire adds a luxurious and elegant touch, making it a gemstone that combines both
                        aesthetic appeal and spiritual importance.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem8.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Spinel</h3>
                    <p>
                        Spinel is a vibrant and versatile gemstone often mistaken for ruby due to its rich red color,
                        though it is also found in pink, blue, purple, and black shades. Valued for its brilliance,
                        hardness, and clarity, spinel has been used in jewelry for centuries. It symbolizes
                        revitalization, energy, and inspiration. Unlike other gemstones, spinel often offers striking
                        color at an affordable price. It is ideal for rings, earrings, pendants, and collectors’ pieces.
                        With its rich history and wide range of colors, spinel has gained recognition as a unique and
                        highly desirable gemstone.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px; order:2;">
                    <img src="{{ asset('images/main_website/web_gem9.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px; order:1;">
                    <h3 style="color:#bfa16a;">Cat's Eye</h3>
                    <p>Cat’s Eye, also known as Cymophane, is a unique gemstone famous for its striking optical
                        phenomenon called “chatoyancy,” which creates a bright, narrow band of light across its surface
                        resembling a cat’s eye. Typically golden, greenish, or brown, this gem symbolizes protection,
                        intuition, and good fortune in astrology. Highly valued for its rarity and distinctive
                        appearance, Cat’s Eye is often used in rings, pendants, and talismans. Its hardness, durability,
                        and captivating shimmer make it a timeless choice for both collectors and jewelry enthusiasts
                        seeking a gemstone with mystical charm and elegance.
                    </p>
                </div>
            </div>


            
            <div style="display:flex; flex-wrap:wrap; gap:40px; align-items:center; margin-bottom:70px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_gem10.png') }}" style="width:100%; border-radius:15px;">
                </div>

                <div style="flex:1; min-width:280px;">
                    <h3 style="color:#bfa16a;">Emerald</h3>
                    <p>
                        Emerald is a precious green gemstone from the beryl family, celebrated for its rich, vibrant
                        color and timeless elegance. Highly prized since ancient times, emerald symbolizes growth,
                        renewal, and prosperity. Its captivating green hue makes it a favorite for rings, necklaces, and
                        high-end jewelry designs. Though slightly softer than other gemstones, skilled cutting and
                        polishing reveal its brilliance and depth. Emeralds are also valued in astrology for enhancing
                        clarity, intuition, and harmony. With their historic significance, striking color, and luxurious
                        appeal, emeralds remain one of the most admired and treasured gemstones worldwide.
                    </p>
                </div>
            </div>


            
            <div style="text-align:center; margin-top:60px;">

                <button id="backGemTypes"
                    style="background:#bfa16a; color:#fff; padding:12px 30px; border:none; border-radius:40px; cursor:pointer;">
                    Back to story
                </button>
            </div>

        </div>
    </section>

    
    <section class="gem-shapes">

        <div class="gem-shapes-container">

            
            <div class="gem-shapes-text">
                <h2>Gem Shapes & Cuts</h2>
                <p>
                    The shape and cut of a gemstone enhance its brilliance and appeal.
                    From classic round cuts to unique fancy shapes, each design reflects
                    artistry and precision. Choosing the right shape accentuates color,
                    clarity, and sparkle, making every gem a masterpiece.
                </p>
                <a href="#" class="gem-shapes-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>

            
            <div class="gem-shapes-image">
                <img src="{{ asset('images/main_website/web_gemshape.jpg') }}" alt="Gem Shapes Banner">
            </div>

        </div>

    </section>

    
    <section id="gem-shapes-details" style="display: none; padding: 60px 20px; background: #fff8f0;">
        <div class="container" style="max-width: 1000px; margin: 0 auto;">

            
            <h2 style="text-align: center; color: #bfa16a; font-size: 2.5rem; margin-bottom: 15px;">
                Gem Shapes & Cuts
            </h2>
            <p style="text-align: center; color: #555; font-size: 1.1rem; margin-bottom: 40px;">
                Gemstone shapes and cuts play a crucial role in determining a gem’s beauty, brilliance, and overall
                value. The shape refers to the outer outline of the stone, such as round, oval, or square. The cut
                refers to how the gem’s facets are arranged to reflect light. A well-executed cut enhances sparkle,
                color, and clarity. Different shapes and cuts are chosen based on the gemstone type, crystal structure,
                and desired jewelry design. From classic round brilliants to elegant emerald cuts and artistic heart
                shapes, each style offers a unique appearance, personality, and level of brilliance.
            </p>

            
            <div style="text-align: center; margin-bottom: 50px;">
                <img src="{{ asset('images/main_website/web_gemshape2.jpg') }}" alt="Gem Shapes Banner"
                    style="width: 100%; max-height: 300px; max-width: 500px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Marquise Shape</h4>
                    <p>The Marquise shape, also known as Navette, is an elongated gemstone with pointed ends and curved
                        sides. This elegant design creates the illusion of a larger stone and makes fingers appear
                        longer and slimmer when set in rings. The marquise cut typically features multiple facets to
                        maximize brilliance and sparkle. It is ideal for showcasing gemstones like sapphires, rubies,
                        and diamonds. Because of its pointed tips, protective settings are often recommended to prevent
                        chipping. The marquise shape combines vintage charm with dramatic elegance, making it a
                        distinctive and eye-catching choice in fine jewelry designs.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut1.png') }}" alt="Round Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut2.jpg') }}" alt="Princess Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Round Shape</h4>
                    <p>The Round shape is the most popular and classic gemstone cut, especially in diamonds. Known as
                        the round brilliant cut, it features numerous precisely arranged facets designed to maximize
                        light reflection and sparkle. This cut offers exceptional brilliance, fire, and symmetry. Its
                        circular outline makes it versatile and suitable for almost any jewelry style, from engagement
                        rings to pendants and earrings. The round cut is carefully engineered to balance brightness and
                        scintillation. Due to its popularity and optimal light performance, it often commands a higher
                        price compared to other shapes of the same carat weight.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Trilliant Shape</h4>
                    <p>The Trilliant shape is a triangular gemstone cut with either sharp or slightly curved sides. It
                        is designed to produce exceptional brilliance through carefully arranged facets. Often used as
                        side stones in rings, trilliant gems can also serve as striking centerpieces in modern jewelry
                        designs. This shape offers a bold and contemporary appearance while maintaining excellent light
                        reflection. Trilliant cuts are commonly seen in diamonds, sapphires, and other precious
                        gemstones. Their geometric form adds a dynamic and stylish touch to jewelry, making them ideal
                        for those seeking a modern and unique aesthetic.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut3.jpg') }}" alt="Emerald Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut4.png') }}" alt="Oval Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Oval Shape</h4>
                    <p>The Oval shape is an elongated version of the round brilliant cut, combining elegance with strong
                        sparkle. Its symmetrical curved outline creates the illusion of greater size and elongates the
                        finger when worn as a ring. Oval cuts feature multiple facets that enhance brilliance and fire.
                        This shape is popular for engagement rings and statement jewelry due to its classic yet slightly
                        modern appeal. It works beautifully with many gemstones, including sapphires, emeralds, and
                        diamonds. The oval cut offers a refined balance between traditional round brilliance and
                        distinctive elongated style.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Pear Shape</h4>
                    <p>The Pear shape, also known as the drop shape, combines the brilliance of a round cut with the
                        elegance of a marquise. It features one rounded end and one pointed tip, creating a teardrop
                        silhouette. This unique design allows for excellent light reflection while offering a graceful
                        and feminine appearance. Pear-shaped gemstones are popular in pendants and earrings, where their
                        drop-like form enhances elegance. When used in rings, proper setting protection is important for
                        the pointed tip. The pear cut symbolizes sophistication and individuality, making it a timeless
                        yet distinctive jewelry choice.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut5.png') }}" alt="Cushion Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut15.png') }}" alt="Oval Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Princess Cut</h4>
                    <p>The Princess cut, also known as the square brilliant cut, is one of the most popular modern
                        gemstone shapes. It features a square outline with sharp corners and numerous brilliant facets
                        designed to maximize sparkle and fire. Developed in the 20th century, the princess cut combines
                        contemporary style with exceptional brilliance. It is especially popular in engagement rings due
                        to its clean lines and striking appearance. The cut’s faceting pattern enhances light reflection
                        while maintaining a bold geometric shape. Princess-cut gemstones offer a perfect balance between
                        classic brilliance and modern sophistication, making them ideal for those who appreciate
                        structured elegance with maximum sparkle.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Square Shape</h4>
                    <p>The Square shape features equal-length sides and sharp corners, giving it a clean and structured
                        appearance. Square gemstones may include different facet styles, such as princess or step cuts,
                        depending on the design. This shape offers a modern and symmetrical look, ideal for contemporary
                        jewelry settings. Square cuts can provide strong brilliance or subtle elegance, depending on the
                        faceting pattern used. They are popular in engagement rings and statement pieces. The square
                        shape emphasizes clarity and structure, making it suitable for those who appreciate bold,
                        geometric designs with balanced proportions.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut6.jpg') }}" alt="Round Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut7.jpg') }}" alt="Princess Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Octagon Shape</h4>
                    <p>The Octagon shape features eight sides and is commonly associated with step cuts, such as the
                        emerald cut. This structured design emphasizes clarity and depth rather than intense sparkle.
                        With long, parallel facets, octagon-shaped gemstones display a sophisticated hall-of-mirrors
                        effect. This shape is particularly popular for emeralds and other transparent gemstones where
                        clarity is important. Its clean lines and geometric symmetry create a refined and elegant
                        appearance. The octagon cut is ideal for those who prefer understated brilliance and a classic,
                        timeless look in their jewelry pieces.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Emerald Cut</h4>
                    <p>The Emerald Cut is a rectangular step cut characterized by long, parallel facets and trimmed
                        corners. Rather than focusing on sparkle, this cut highlights a gemstone’s clarity, color, and
                        natural beauty. The large, open table creates a mirror-like reflection known as the
                        “hall-of-mirrors” effect. Emerald cuts are especially popular for emeralds, diamonds, and
                        sapphires. Because this cut reveals inclusions more easily, high-quality stones are preferred.
                        The emerald cut offers timeless sophistication and vintage charm, making it a favorite for
                        elegant engagement rings and high-end jewelry designs that emphasize purity and refinement.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut8.jpg') }}" alt="Emerald Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut9.jfif') }}" alt="Oval Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Baguette Cut</h4>
                    <p>The Baguette cut is a long, narrow rectangular gemstone with step-cut facets. It typically has
                        fewer facets than brilliant cuts, resulting in subtle sparkle rather than intense brilliance.
                        Baguette gemstones are commonly used as accent stones alongside larger center gems in rings and
                        bracelets. Their clean, straight lines create a sleek and modern look. The simplicity of the
                        baguette cut enhances symmetry and balance in jewelry designs. It is ideal for those who prefer
                        understated elegance and structured aesthetics over dramatic sparkle.</p>
                    </p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Tapered Baguette Cut</h4>
                    <p>The Tapered Baguette is similar to the standard baguette but gradually narrows toward one end.
                        This design makes it ideal as a side stone in rings, where it complements a larger center gem.
                        Featuring step-cut facets, tapered baguettes provide subtle brilliance and a refined appearance.
                        Their angled shape allows them to fit seamlessly into intricate jewelry settings. The clean
                        lines and geometric precision create a polished, sophisticated look. Tapered baguettes are often
                        used in engagement rings to enhance symmetry and highlight the central gemstone.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut10.png') }}" alt="Cushion Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>


            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut11.jpg') }}" alt="Princess Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Antique Cushion</h4>
                    <p>The Antique Cushion cut, often called the cushion cut, features a square or rectangular shape
                        with softly rounded corners, resembling a pillow. This vintage-inspired cut has large facets
                        that enhance brilliance while giving the gemstone a romantic, classic appearance. Antique
                        cushion cuts often display a slightly deeper pavilion, creating a warm glow rather than sharp
                        sparkle. Popular during the 18th and 19th centuries, this cut is now highly desired for
                        engagement rings and luxury jewelry. It beautifully balances brilliance and depth, making it
                        ideal for diamonds, sapphires, and other precious gemstones. The antique cushion cut represents
                        timeless elegance with a touch of old-world charm.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Heart Shape</h4>
                    <p>The Heart shape is a symbol of love and romance, making it a meaningful and expressive gemstone
                        cut. It requires exceptional precision to achieve perfect symmetry, with two equal rounded lobes
                        and a sharp pointed tip. This brilliant-style cut maximizes sparkle while maintaining its
                        distinctive outline. Heart-shaped gemstones are often used in pendants, rings, and anniversary
                        jewelry. Due to its pointed tip, protective settings are recommended to prevent damage. The
                        heart cut is both sentimental and eye-catching, ideal for those who want jewelry that represents
                        deep emotion, affection, and timeless devotion.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut12.jpg') }}" alt="Emerald Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut13.png') }}" alt="Oval Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Briolette Cut</h4>
                    <p>The Briolette cut is a pear-shaped gemstone fully covered with triangular or diamond-shaped
                        facets around its entire surface. Unlike traditional cuts with a flat top, the briolette has no
                        table and is usually drilled at the top to be suspended as a pendant or earring drop. This
                        design allows light to reflect beautifully from all angles, creating exceptional sparkle and
                        movement. Briolettes are commonly used in earrings and necklaces rather than rings. Their
                        elegant, dangling form adds grace and sophistication to jewelry designs, making them a popular
                        choice for luxurious and artistic pieces.</p>
                </div>
            </div>

            
            <div class="shape-detail"
                style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 40px; gap: 20px;">
                <div style="flex:1; min-width:280px;">
                    <h4 style="color: #bfa16a;">Cabochon Cut</h4>
                    <p>The Cabochon cut is a smooth, rounded gemstone shape without facets. It typically features a flat
                        bottom and a domed top. Unlike brilliant cuts designed for sparkle, cabochons emphasize color,
                        surface beauty, and unique optical effects such as chatoyancy (cat’s eye) or star effects. This
                        cut is commonly used for opaque or translucent gemstones like opal, turquoise, and cat’s eye.
                        The polished surface highlights the stone’s natural texture and color depth. Cabochons offer a
                        soft, elegant appearance and are widely used in rings, pendants, and vintage-style jewelry,
                        showcasing simplicity and natural beauty.</p>
                </div>
                <div style="flex:1; min-width:280px;">
                    <img src="{{ asset('images/main_website/web_cut14.jpg') }}" alt="Cushion Cut"
                        style="width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                </div>
            </div>



            
            <div style="text-align: center; margin-top: 50px;">
                <button id="backGemShapes"
                    style="background:#bfa16a; color:#fff; padding:12px 30px; border:none; border-radius:40px; cursor:pointer;">
                    Back to story
                </button>
            </div>

        </div>
    </section>


    
    <section class="colors-banner">

        
        <div class="colors-overlay"></div>

        
        <div class="colors-banner-content">
            <span class="banner-small">Gemstone Spectrum</span>

            <h2>Explore the Colors of Gems</h2>

            <p>
                Discover the vibrant colors of gemstones, each representing unique beauty, energy, and symbolism. From
                fiery reds to calming blues, every gem tells a story.
            </p>

            <a href="javascript:void(0);" class="banner-btn colors-btn" id="learnColorsBtn">
                Learn More <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    
    <section id="gem-colors-details" style="display:none; padding:80px 20px; background:#fff8f0;">

        <div class="colors-container">

            <h2 class="colors-main-title">Gemstones by Color Categories</h2>

            <p class="colors-main-desc">
                Gemstones appear in a stunning spectrum of colors, each representing unique beauty,
                symbolism, and natural rarity. From deep passionate reds to calming blues and rare
                color-changing stones, every gemstone color holds its own story and meaning.
            </p>


            
            <div class="color-row">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web-gem6.png') }}" alt="Red Gemstones">
                </div>

                <div class="color-content">
                    <h3>Red Gemstones</h3>
                    <p class="color-desc">
                        Red gemstones symbolize passion, power, and love. Their bold appearance makes them
                        one of the most luxurious and eye-catching gemstones in the world.
                    </p>

                    <ul>
                        <li><b>Ruby</b> – The most famous red gemstone known for its deep crimson brilliance.</li>
                        <li><b>Garnet</b> – Rich deep red stone symbolizing protection and strength.</li>
                        <li><b>Spinel</b> – Often mistaken for ruby but admired for its vivid red tones.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row reverse">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_gem6.png') }}" alt="Blue Gemstones">
                </div>

                <div class="color-content">
                    <h3>Blue Gemstones</h3>
                    <p class="color-desc">
                        Blue gemstones represent wisdom, loyalty, and serenity. Their cool tones create
                        an elegant and timeless appearance in jewelry.
                    </p>

                    <ul>
                        <li><b>Blue Sapphire</b> – Famous for its royal blue brilliance.</li>
                        <li><b>Aquamarine</b> – Ocean-blue gemstone known for its calm energy.</li>
                        <li><b>Tanzanite</b> – Rare gemstone with deep blue-violet tones.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_cut4.png') }}" alt="Green Gemstones">
                </div>

                <div class="color-content">
                    <h3>Green Gemstones</h3>
                    <p class="color-desc">
                        Green gemstones symbolize growth, prosperity, and harmony with nature.
                    </p>

                    <ul>
                        <li><b>Emerald</b> – Deep luxurious green and highly valuable.</li>
                        <li><b>Peridot</b> – Bright olive green gemstone with fresh energy.</li>
                        <li><b>Jade</b> – Smooth green stone valued culturally for centuries.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row reverse">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_gem4.png') }}" alt="Yellow Gemstones">
                </div>

                <div class="color-content">
                    <h3>Yellow & Golden Gemstones</h3>
                    <p class="color-desc">
                        Yellow gemstones represent wealth, positivity, and success.
                    </p>

                    <ul>
                        <li><b>Yellow Sapphire</b> – Bright golden gemstone important in astrology.</li>
                        <li><b>Topaz</b> – Honey-gold gemstone with radiant shine.</li>
                        <li><b>Citrine</b> – Warm golden quartz known for prosperity energy.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_gem2.png') }}" alt="Purple Gemstones">
                </div>

                <div class="color-content">
                    <h3>Purple & Violet Gemstones</h3>
                    <p class="color-desc">
                        Purple gemstones symbolize spirituality, creativity, and luxury.
                    </p>

                    <ul>
                        <li><b>Amethyst</b> – Most famous purple gemstone with calming energy.</li>
                        <li><b>Tanzanite</b> – Unique blue-violet gemstone with rich brilliance.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row reverse">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_gem3.png') }}" alt="White Gemstones">
                </div>

                <div class="color-content">
                    <h3>White & Colorless Gemstones</h3>
                    <p class="color-desc">
                        Colorless gemstones symbolize purity, elegance, and brilliance.
                    </p>

                    <ul>
                        <li><b>Diamond</b> – The most brilliant and valuable gemstone.</li>
                        <li><b>White Sapphire</b> – A sparkling alternative to diamond.</li>
                    </ul>
                </div>
            </div>


            
            <div class="color-row">
                <div class="color-image">
                    <img src="{{ asset('images/main_website/web_oct.png') }}" alt="Multi Color Gems">
                </div>

                <div class="color-content">
                    <h3>Multi-Color & Color-Changing Gems</h3>
                    <p class="color-desc">
                        Some rare gemstones display multiple colors naturally depending on lighting.
                    </p>

                    <ul>
                        <li><b>Alexandrite</b> – Changes color from green to red.</li>
                        <li><b>Opal</b> – Displays stunning rainbow color flashes.</li>
                    </ul>
                </div>
            </div>


            <div class="back-btn-wrap">
                <button id="backColors">Back to story</button>
            </div>

        </div>
    </section>


    
    <section class="birth-gems">

        <div class="birth-container">

            
            <div class="birth-text">
                <h2>Gems for Birth Month</h2>

                <p>
                    Birthstones are gemstones associated with each month of the year.
                    These stones are believed to bring luck, protection, and positive
                    energy to those born in their respective months. From the vibrant
                    Ruby of July to the elegant Sapphire of September, birthstones add
                    both beauty and personal meaning to jewelry.
                </p>

                <a href="#" class="birth-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>

            
            <div class="birth-image">
                <img src="{{ asset('images/main_website/web_birth.png') }}" alt="Birth Month Gems">
            </div>

        </div>

    </section>


    
    <section id="birth-details" style="display:none; padding:80px 20px; background:#fff8f0;">

        <div style="max-width:1200px; margin:auto;">

            <h2 style="text-align:center; font-size:2.6rem; color:#bfa16a; margin-bottom:20px;">
                Birthstones by Month
            </h2>

            <p
                style="text-align:center; max-width:850px; margin:auto; color:#555; line-height:1.8; margin-bottom:60px;">
                Each month of the year is associated with a unique gemstone known as a birthstone.
                These gems are believed to bring luck, protection, and special meaning to individuals
                born in that month. Birthstones are widely used in rings, necklaces, and personalized
                jewelry, making them a meaningful gift for birthdays and celebrations.
            </p>


            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_jan.jpg') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>January – Garnet</h3>
                    <p>Garnet, January’s birthstone, is admired for its deep red hue, symbolizing protection, passion,
                        and vitality. Historically treasured by royalty and warriors, it is believed to bring strength,
                        courage, and positive energy to its wearer. Garnet’s durability and brilliance make it ideal for
                        rings, necklaces, and decorative jewelry, blending beauty with meaning.</p>
                </div>
            </div>


            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_feb.jpg') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>February – Amethyst</h3>
                    <p>Amethyst is February’s birthstone, famous for its calming purple shades and spiritual
                        significance. Known for clarity, peace, and protection, amethyst promotes emotional balance and
                        wisdom. Its timeless beauty has made it a favorite for centuries, adorning rings, necklaces, and
                        decorative pieces. This gemstone symbolizes inner strength, serenity, and spiritual growth.</p>
                </div>
            </div>


            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_march.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>March – Aquamarine</h3>
                    <p>Aquamarine, March’s birthstone, is cherished for its serene blue-green color, representing
                        courage, clarity, and tranquility. Believed to calm the mind and protect travelers, it has been
                        treasured since ancient times. Aquamarine is widely used in rings, pendants, and elegant jewelry
                        designs. Its soothing hue and symbolic meaning make it a timeless and refreshing gemstone.</p>
                </div>
            </div>


            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_aprail.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>April – Diamond</h3>
                    <p>Diamond is April’s birthstone, renowned for its unmatched brilliance, hardness, and clarity.
                        Symbolizing eternal love, strength, and purity, diamonds are the most sought-after gemstones
                        worldwide. Often featured in engagement rings and luxury jewelry, diamonds remain timeless
                        treasures. Their sparkling appearance and enduring value make them a symbol of everlasting
                        beauty and prestige.</p>
                </div>
            </div>


            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_may.jpg') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>May – Emerald</h3>
                    <p>Emerald, May’s birthstone, is celebrated for its vibrant green hue and elegance. It symbolizes
                        growth, harmony, and prosperity, historically treasured by royalty. Emeralds are used in rings,
                        necklaces, and fine jewelry, offering both aesthetic beauty and spiritual significance. This
                        gemstone enhances intuition, clarity, and balance, making it a timeless symbol of luxury and
                        refinement.</p>
                </div>
            </div>


            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_june.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>June – Alexandrite</h3>
                    <p>Alexandrite, June’s birthstone, is a rare and enchanting gem known for its color-changing
                        ability—green in daylight, red under artificial light. Symbolizing balance, transformation, and
                        good fortune, it is highly prized among collectors. Alexandrite is perfect for rings and
                        pendants, offering mystical charm and elegance while showcasing one of the most unique optical
                        phenomena in gemstones.</p>
                </div>
            </div>



            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_july.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>July – Ruby</h3>
                    <p>Ruby, July’s birthstone, is a fiery red gemstone symbolizing passion, courage, and vitality.
                        Highly valued for its brilliance and hardness, ruby has been a favorite of royalty for
                        centuries. It is used in rings, necklaces, and luxury jewelry. The deep red hue and powerful
                        symbolism make ruby a gemstone of energy, love, and enduring beauty.</p>
                </div>
            </div>


            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_aug.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>August – Peridot</h3>
                    <p>Peridot, August’s birthstone, is a bright green gemstone symbolizing positivity, protection, and
                        harmony. Known for its refreshing color and vitality, it is believed to bring success and good
                        fortune. Peridot is widely used in rings, pendants, and earrings. Its vibrant hue and cheerful
                        appearance make it a gemstone that embodies optimism and natural elegance.</p>
                </div>
            </div>


            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_sep.jpg') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>September – Sapphire</h3>
                    <p>Sapphire, September’s birthstone, is celebrated for its deep blue color, representing wisdom,
                        loyalty, and protection. Historically worn by royalty, it symbolizes truth and spiritual
                        insight. Sapphires are durable, making them ideal for rings, necklaces, and elegant jewelry.
                        Their timeless beauty and rich meaning ensure they remain one of the most admired gemstones.</p>
                </div>
            </div>


            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_oct.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>October – Opal</h3>
                    <p>Opal, October’s birthstone, is admired for its play-of-color and mystical charm. Symbolizing
                        creativity, inspiration, and hope, opal’s iridescent flashes make each stone unique. It is used
                        in rings, pendants, and artistic jewelry designs. Opal enhances imagination and emotional
                        balance, making it a gemstone of individuality and artistic expression.
                </div>
            </div>


            
            <div class="birth-gem-row">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_nov.jpg') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>November – Topaz</h3>
                    <p>Topaz, November’s birthstone, is valued for its warm yellow or golden tones, symbolizing
                        strength, intelligence, and healing. Historically believed to bring protection and fortune, it
                        is widely used in rings, necklaces, and elegant jewelry. Topaz combines aesthetic beauty with
                        symbolic significance, offering both brilliance and positive energy to its wearer.
                </div>
            </div>

            
            <div class="birth-gem-row reverse">
                <div class="birth-gem-img">
                    <img src="{{ asset('images/main_website/web_dec.png') }}">
                </div>

                <div class="birth-gem-text">
                    <h3>December – Tanzanite</h3>
                    <p>Tanzanite, December’s birthstone, is a rare blue-violet gemstone discovered in modern times.
                        Symbolizing transformation, intuition, and spiritual growth, it is highly prized for its vibrant
                        color and rarity. Tanzanite is commonly used in rings, pendants, and fine jewelry. Its striking
                        hue and mystical appeal make it a gemstone of elegance and distinction.
                </div>
            </div>

            
            <div style="text-align:center; margin-top:60px;">
                <button id="backBirth"
                    style="background:#bfa16a; color:#fff; padding:12px 30px; border:none; border-radius:40px; cursor:pointer;">
                    Back to story
                </button>
            </div>

        </div>
    </section>

    

    <section class="ascendant-gem-section">

        <div class="ascendant-container">

            
            <div class="ascendant-image">
                <img src="{{ asset('images/main_website/web_astro.png') }}" alt="Ascendant Sign Gemstone">
            </div>

            
            <div class="ascendant-content">

                <span class="asc-small-title">Astrology & Gemstones</span>

                <h2>Ascendant Sign Gemstones</h2>

                <p>
                    In astrology, the Ascendant (Rising Sign) plays an important role in
                    determining a person’s personality and life path. Specific gemstones
                    are believed to enhance positive planetary energies connected to
                    your ascendant sign. Wearing the right gemstone may bring balance,
                    prosperity, and protection.
                </p>

                <a href="#" class="asc-btn">
                    Learn More
                </a>

            </div>

        </div>

    </section>

    
    <section id="ascendant-details" class="ascendant-details">
        <div class="asc-container">

            
            <div class="asc-head">
                <h2 class="asc-title">Ascendant Sign Gemstones</h2>
                <p class="asc-subtitle">
                    Gemstones have long been connected with zodiac signs, guiding individuals through the influence of astrology and planetary energies. Each zodiac sign is associated with a specific gemstone believed to enhance strengths, balance weaknesses, and attract positive energy. From the protective power of Red Coral to the brilliance of Diamond and the wisdom of Blue Sapphire, these stones hold deep symbolic meaning.
                </p>
            </div>

            
            <div class="asc-main-image">
                <img src="{{ asset('images/main_website/web_lagna1.png') }}" alt="Ascendant Gemstones">
            </div>

            <p class="asc-intro-text">
                Wearing the right zodiac gemstone is thought to promote harmony, confidence, prosperity, and emotional stability. Whether it is the vibrant Ruby or the calming glow of Pearl, each gem supports personal growth and spiritual balance, helping individuals align with their cosmic path.
            </p>

            
            <div class="asc-grid">

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Aries</span>
                        <span class="asc-gem">Red Coral</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_aries.jpg') }}" alt="Aries">
                        <img src="{{ asset('images/main_website/web_aries1.jpg') }}" alt="Red Coral">
                    </div>
                    <p class="asc-card-desc">
                        Red Coral is associated with strength, courage, and energy. For Aries, it enhances confidence, leadership qualities, and determination. This vibrant red organic gem is believed to remove negativity and boost vitality, helping Aries individuals stay focused, ambitious, and motivated in their personal and professional life.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Taurus</span>
                        <span class="asc-gem">Diamond</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Taurush.jpg') }}" alt="Taurus">
                        <img src="{{ asset('images/main_website/fp_8.jfif') }}" alt="Diamond">
                    </div>
                    <p class="asc-card-desc">
                        Diamond symbolizes strength, purity, and stability for Taurus. It enhances clarity, commitment, and emotional balance. Known for its unmatched brilliance and durability, diamond supports Taurus individuals in building lasting relationships and achieving steady success with confidence and determination.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Gemini</span>
                        <span class="asc-gem">Emerald</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Gemini.jpg') }}" alt="Gemini">
                        <img src="{{ asset('images/main_website/web_Gemini1.jpg.png') }}" alt="Emerald">
                    </div>
                    <p class="asc-card-desc">
                        Emerald represents intelligence, communication, and harmony. For Gemini, it strengthens mental clarity, creativity, and expression. This vibrant green stone promotes emotional balance and helps Geminis make wise decisions while enhancing their natural charm and adaptability.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Cancer</span>
                        <span class="asc-gem">Pearl</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Cancer.jpg') }}" alt="Cancer">
                        <img src="{{ asset('images/main_website/web_Cancer1.jpg') }}" alt="Pearl">
                    </div>
                    <p class="asc-card-desc">
                        Pearl symbolizes purity, calmness, and emotional healing. For Cancer, it enhances intuition, inner peace, and nurturing qualities. Pearls are believed to balance emotions and provide protection, supporting Cancer individuals in maintaining harmony in relationships and personal life.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Leo</span>
                        <span class="asc-gem">Ruby</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Leo.jpg') }}" alt="Leo">
                        <img src="{{ asset('images/main_website/web_Leo1.jpg.png') }}" alt="Ruby">
                    </div>
                    <p class="asc-card-desc">
                        Ruby reflects passion, power, and leadership. For Leo, it strengthens courage, confidence, and vitality. This fiery red gemstone enhances ambition and attracts success, helping Leos shine brightly and maintain their natural authority and charisma.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Virgo</span>
                        <span class="asc-gem">Emerald</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Virgo.jpg') }}" alt="Virgo">
                        <img src="{{ asset('images/main_website/web_Virgo1.jpg') }}" alt="Emerald">
                    </div>
                    <p class="asc-card-desc">
                        Emerald promotes wisdom, clarity, and balance. For Virgo, it supports analytical thinking and emotional stability. Emerald enhances focus and harmony, helping Virgo individuals achieve personal growth while maintaining their practical and organized nature.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Libra</span>
                        <span class="asc-gem">Diamond</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Libra.jpg') }}" alt="Libra">
                        <img src="{{ asset('images/main_website/web_gem3.png') }}" alt="Diamond">
                    </div>
                    <p class="asc-card-desc">
                        Diamond symbolizes balance, love, and clarity for Libra. It strengthens relationships and enhances decision-making abilities. Diamond helps Libra individuals maintain harmony, attract positivity, and achieve emotional and financial stability with grace.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Scorpio</span>
                        <span class="asc-gem">Red Coral</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Scorpio.jpg') }}" alt="Scorpio">
                        <img src="{{ asset('images/main_website/web_aries1.jpg') }}" alt="Red Coral">
                    </div>
                    <p class="asc-card-desc">
                        Red Coral enhances courage, passion, and protection for Scorpio. It strengthens determination and removes negative energy. This powerful gemstone supports Scorpio’s intense nature while promoting emotional balance and resilience.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Sagittarius</span>
                        <span class="asc-gem">Yellow Sapphire</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Sagittarius.jpg') }}" alt="Sagittarius">
                        <img src="{{ asset('images/main_website/web_yellow1.jpg') }}" alt="Yellow Sapphire">
                    </div>
                    <p class="asc-card-desc">
                        Yellow Sapphire symbolizes wisdom, prosperity, and good fortune. For Sagittarius, it enhances optimism, confidence, and success. This bright golden gemstone attracts abundance and supports spiritual growth while strengthening leadership qualities.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Capricorn</span>
                        <span class="asc-gem">Blue Sapphire</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Capricorn.jpg') }}" alt="Capricorn">
                        <img src="{{ asset('images/main_website/web_gem4.png') }}" alt="Blue Sapphire">
                    </div>
                    <p class="asc-card-desc">
                        Blue Sapphire represents discipline, focus, and protection. For Capricorn, it enhances determination and career success. This deep blue gemstone promotes clarity and stability, helping Capricorns achieve long-term goals with strength and confidence.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Aquarius</span>
                        <span class="asc-gem">Blue Sapphire</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Aquarius.jpg') }}" alt="Aquarius">
                        <img src="{{ asset('images/main_website/web_gem8.png') }}" alt="Blue Sapphire">
                    </div>
                    <p class="asc-card-desc">
                        Blue Sapphire encourages wisdom, insight, and mental clarity. For Aquarius, it strengthens intuition and supports innovative thinking. This gemstone brings stability and protection, helping Aquarius individuals stay balanced while pursuing creative ideas.
                    </p>
                </div>

                
                <div class="asc-card">
                    <div class="asc-card-top">
                        <span class="asc-sign">Pisces</span>
                        <span class="asc-gem">Yellow Sapphire</span>
                    </div>
                    <div class="asc-card-images">
                        <img src="{{ asset('images/main_website/web_Pisces.jpg') }}" alt="Pisces">
                        <img src="{{ asset('images/main_website/web_yellows.jpg') }}" alt="Yellow Sapphire">
                    </div>
                    <p class="asc-card-desc">
                        Yellow Sapphire promotes positivity, prosperity, and spiritual awareness. For Pisces, it enhances intuition and emotional balance. This warm golden gemstone attracts success and supports personal growth while maintaining harmony in relationships.
                    </p>
                </div>

            </div>

            
            <div class="asc-actions">
                <button id="backAscendant" class="asc-back-btn">Back to story</button>
            </div>

        </div>
    </section>

    
    <section class="gem-insight-banner">
        <div class="gem-insight-overlay"></div>
        <div class="gem-insight-content">
            <span class="gem-insight-small">Astrology & Planets</span>
            <h2>Gems for Planets</h2>
            <p>
                In Vedic astrology, planets are linked with specific gemstones that are believed to strengthen
                beneficial effects and balance challenging energies in life.
            </p>
            <a href="#" class="gem-insight-btn">Learn More <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    
    <section id="gem-insight-details">
        <div class="insight-container">
            <h2 class="insight-title">Gems for Planets</h2>
            <p class="insight-subtitle">
                Each planet governs specific areas of life such as confidence, wisdom, communication, relationships,
                discipline, and emotional well-being. The right planetary gemstone is traditionally selected to support
                harmony and positive outcomes.Planetary gemstones, known in Vedic astrology as Navagraha gems, are associated with the nine celestial influences that shape human life. Each planet is believed to radiate specific energies that affect personality, health, career, and relationships.

            </p>

            <div class="insight-main-image">
                <img src="{{ asset('images/main_website/web_planet1.jpg') }}" alt="Planetary Gemstones">
            </div>

            <p class="insight-intro">
                Gemstones such as Ruby for the Sun and Pearl for the Moon are traditionally worn to strengthen positive planetary effects and reduce challenges.
Other powerful gems like Blue Sapphire for Saturn and Emerald for Mercury are chosen based on an individual’s birth chart. When properly selected, these gemstones are believed to promote balance, prosperity, protection, and spiritual growth.
            </p>

            <div class="insight-grid">
                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web-gem6.png') }}" alt="Ruby Gemstone">
                        <img src="{{ asset('images/main_website/web_planet2.jpg') }}" alt="Sun Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Sun - Ruby</h3>
                        <p>
                            Ruby represents the Sun and symbolizes power, authority, and vitality. It strengthens leadership qualities, confidence, and self-esteem. Wearing ruby is believed to enhance success, recognition, and inner strength.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_Cancer1.jpg') }}" alt="Pearl Gemstone">
                        <img src="{{ asset('images/main_website/web_planet3.jpg') }}" alt="Moon Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Moon - Pearl</h3>
                        <p>
                            Pearl is associated with the Moon and promotes emotional balance, peace, and calmness. It enhances mental clarity, intuition, and nurturing qualities while reducing stress and emotional instability.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_aries1.jpg') }}" alt="Red Coral Gemstone">
                        <img src="{{ asset('images/main_website/web_mars.jpg') }}" alt="Mars Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Mars - Red Coral</h3>
                        <p>
                           Red Coral represents Mars and is known for boosting courage, energy, and action. It strengthens determination, stamina, and protection against negative influences.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_Gemini1.jpg.png') }}" alt="Emerald Gemstone">
                        <img src="{{ asset('images/main_website/web_Mercury.jpg') }}" alt="Mercury Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Mercury - Emerald</h3>
                        <p>
                           Emerald is linked with Mercury and supports intelligence, communication, and business skills. It enhances analytical thinking, creativity, and decision-making abilities.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_yellow1.jpg') }}" alt="Yellow Sapphire Gemstone">
                        <img src="{{ asset('images/main_website/web_Jupiter.jfif') }}" alt="Jupiter Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Jupiter - Yellow Sapphire</h3>
                        <p>
                           Yellow Sapphire is associated with Jupiter and symbolizes wisdom, prosperity, and spiritual growth. It is believed to attract abundance, education, and good fortune.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_gem3.png') }}" alt="Diamond Gemstone">
                        <img src="{{ asset('images/main_website/web_Venus.jpg') }}" alt="Venus Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Venus - Diamond</h3>
                        <p>
                           Diamond represents Venus and enhances love, luxury, beauty, and artistic expression. It promotes harmony in relationships and attracts wealth and comfort.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_gem4.png') }}" alt="Blue Sapphire Gemstone">
                        <img src="{{ asset('images/main_website/web_Saturn.jpg') }}" alt="Saturn Planet">
                    </div>
                    <div class="insight-card-body">
                        <h3>Saturn - Blue Sapphire</h3>
                        <p>
                            Blue Sapphire is linked with Saturn and strengthens discipline, focus, and responsibility. It supports long-term stability, career growth, and protection.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_gem7.png') }}" alt="Hessonite Gemstone">
                        <img src="{{ asset('images/main_website/web_rahu.jfif') }}" alt="Rahu">
                    </div>
                    <div class="insight-card-body">
                        <h3>Rahu - Hessonite</h3>
                        <p>
                            Hessonite (Gomed) is associated with Rahu and helps reduce confusion, fear, and negative thinking. It supports confidence, clarity, and practical success.
                        </p>
                    </div>
                </div>

                <div class="insight-card">
                    <div class="insight-card-images">
                        <img src="{{ asset('images/main_website/web_gem9.png') }}" alt="Cat's Eye Gemstone">
                        <img src="{{ asset('images/main_website/web_kethu.png') }}" alt="Ketu">
                    </div>
                    <div class="insight-card-body">
                        <h3>Ketu - Cat's Eye</h3>
                        <p>
                          Cat’s Eye represents Ketu and provides protection, spiritual awareness, and guidance during uncertain times. It enhances intuition and removes obstacles.
                        </p>
                    </div>
                </div>
            </div>

            <div class="insight-actions">
                <button id="backGemInsight">Back to story</button>
            </div>
        </div>
    </section>

    
    <section class="navaratna-ring-section">
        <div class="navaratna-ring-container">
            <div class="navaratna-content">
                <span class="tag">Sacred Gem Design</span>
                <h2 class="navaratna-title">The <span>Navaratna Ring</span> Cosmic Signature</h2>
                <p class="navaratna-desc">
                    Navaratna means "nine gems," each representing one planetary energy in Vedic astrology. A
                    Navaratna ring is traditionally worn as a balanced talisman, combining all major planetary
                    influences in a single powerful design while preserving timeless elegance.
                </p>
                <div class="navaratna-points">
                    <span>9 Planetary Gems</span>
                    <span>Protective Symbolism</span>
                    <span>Royal Heritage Craft</span>
                </div>
                <a href="#" class="navaratna-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="navaratna-visual">
                <img src="{{ asset('images/main_website/web_nawrathna3.jpg') }}" alt="Navaratna Ring Design">
            </div>
        </div>
    </section>

    
<section id="navaratna-details">
    <div class="navaratna-details-wrap">

        
        <h2 class="navaratna-d-title">Navaratna Ring: The Nine-Gem Planetary Harmony</h2>

        
        <p class="navaratna-d-sub">
            A Navaratna ring combines nine sacred gemstones, each linked with one planetary force in Vedic astrology.
            Together, they are traditionally worn for balance, protection, confidence, and prosperity.
        </p>

        
        <div class="navaratna-d-main">
            <img src="{{ asset('images/main_website/web_nawrathna1.png') }}" alt="Navaratna Ring Main">
        </div>

        
        <p class="navaratna-d-note">
            This design is admired for both symbolism and beauty. The nine stones are chosen for harmony and visual balance,
            making Navaratna jewelry a timeless spiritual and royal heritage piece.
        </p>

        
        <div class="navaratna-split">
            <div class="navaratna-split-img">
                <img src="{{ asset('images/main_website/web_nawrathna4.jfif') }}" alt="Navaratna ring close up">
            </div>

            <div class="navaratna-split-text">
                <h3>Meaning and Spiritual Significance of the Navarathna Ring</h3>
                <p>
                    The Navarathna ring, also known as Navaratna, is a sacred and powerful jewelry piece in Vedic astrology. The word “Navarathna” means “nine gems,” representing the nine planetary influences (Navagraha) believed to shape human destiny. Unlike single-planet gemstone rings, the Navarathna ring combines all nine planetary gemstones into one harmonious design. It is worn to balance planetary energies, reduce negative influences, and attract overall prosperity, protection, and success.

This ring is not only an ornament but also a spiritual symbol of cosmic balance. It is believed that wearing all nine gemstones together creates harmony in life by strengthening positive energies from every planet.
                </p>
                <div class="navaratna-tags">
                    <span>Heritage</span>
                    <span>Harmony</span>
                    <span>Protection</span>
                </div>
            </div>
        </div>

        
        <p class="navaratna-mid-note">
            The Navarathna ring combines nine sacred gemstones representing the planetary forces in Vedic astrology. It is believed to balance cosmic energies, reduce negative influences, and promote protection, prosperity, emotional stability, and spiritual growth for the wearer, bringing harmony and success in life.

        </p>

        
        <div class="navaratna-split reverse">
            <div class="navaratna-split-text">
                <h3>The Nine Sacred Gemstones and Their Planets</h3>
                <p>
Each gemstone in the Navarathna ring represents a specific planet. The center stone is typically Ruby, symbolizing the Sun, which represents power and vitality. Surrounding it are eight sacred stones: Pearl (Moon – peace and emotional balance), Red Coral (Mars – courage and strength), Emerald (Mercury – intelligence and communication), Yellow Sapphire (Jupiter – wisdom and prosperity), Diamond (Venus – love and luxury), Blue Sapphire (Saturn – discipline and stability), Hessonite (Rahu – clarity and confidence), and Cat's Eye (Ketu – protection and spiritual awareness).

Together, these gemstones represent complete planetary balance.
                </p>
                
            </div>

            <div class="navaratna-split-img">
                <img src="{{ asset('images/main_website/web_nawrathna2.jpg') }}" alt="Navaratna gemstones set">
            </div>
        </div>

        
        <p class="navaratna-mid-note">
            Worn for centuries in traditional astrology, the Navarathna ring symbolizes unity of the nine planets and is believed to enhance positive vibrations, strengthen confidence, attract good fortune, and provide spiritual protection while maintaining balance and harmony in everyday life experiences.

        </p>

        
        <div class="navaratna-split">
            <div class="navaratna-split-img">
                <img src="{{ asset('images/main_website/web_nawrathna5.png') }}" alt="Navaratna ring close up">
            </div>

            <div class="navaratna-split-text">
                <h3>Design, Benefits, and Cultural Importance</h3>
                <p>
                    The Navarathna ring follows a traditional arrangement where the ruby is placed at the center and the other eight stones surround it in a specific pattern. It is commonly set in gold, considered auspicious and energy-enhancing. The vibrant combination of red, blue, green, yellow, and white gemstones creates a striking and luxurious appearance.

Beyond its beauty, the ring is believed to bring health, prosperity, emotional stability, protection, and spiritual growth. It symbolizes unity, harmony, and the balance of cosmic forces. Today, the Navarathna ring remains both a powerful spiritual talisman and a timeless cultural treasure.
                </p>
                
            </div>
        </div>

        
        <p class="navaratna-end-note">
            Wearing a Navarathna ring is believed to bring overall well-being, success, protection, and spiritual growth. By uniting the energies of all nine planets, it symbolizes completeness, balance, and universal harmony in life.
        </p>

        
        <div class="navaratna-d-actions">
            <button id="backNavaratna">Back to story</button>
        </div>

    </div>
</section>

    
    <x-footer />


    
    <button id="scrollTopBtn">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            navUl.classList.toggle('show');
        });

        const gemstonesSection = document.querySelector('.gemstones-section');
        const miningBanner = document.querySelector('.mining-banner');
        const gemTypesSection = document.getElementById('gem-types');
        const birthSection = document.querySelector('.birth-gems');
        const gemShapesSection = document.querySelector('.gem-shapes');
        const colorsBanner = document.querySelector('.colors-banner');
        const ascendantSection = document.querySelector('.ascendant-gem-section');
        const gemInsightSection = document.querySelector('.gem-insight-banner');
        const navaratnaSection = document.querySelector('.navaratna-ring-section');

        const gemDetails = document.getElementById('gem-details');
        const gemTypesDetails = document.getElementById('gem-types-details');
        const birthDetails = document.getElementById('birth-details');
        const gemShapesDetails = document.getElementById('gem-shapes-details');
        const colorsDetails = document.getElementById('gem-colors-details');
        const ascendantDetails = document.getElementById('ascendant-details');
        const gemInsightDetails = document.getElementById('gem-insight-details');
        const navaratnaDetails = document.getElementById('navaratna-details');

        const learnMoreBtn = document.getElementById('learnMoreBtn');
        const backBtn = document.getElementById('backToStory');
        const gemDetailsAnim = gemDetails ? gemDetails.querySelector('.gem-details-anim') : null;

        const replayBottomUp = (element) => {
            if (!element) return;
            element.classList.remove('is-visible');
            void element.offsetWidth;
            element.classList.add('is-visible');
        };

        learnMoreBtn.addEventListener('click', () => {
            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            gemDetails.style.display = 'block';
            replayBottomUp(gemDetailsAnim);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backBtn.addEventListener('click', () => {
            gemDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const loadGemTypesBtn = document.getElementById('loadGemTypes');
        const backGemTypesBtn = document.getElementById('backGemTypes');

        loadGemTypesBtn.addEventListener('click', () => {
            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            gemTypesDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backGemTypesBtn.addEventListener('click', () => {
            gemTypesDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const gemShapesBtn = document.querySelector('.gem-shapes-btn');
        const backGemShapes = document.getElementById('backGemShapes');

        gemShapesBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            gemShapesDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backGemShapes.addEventListener('click', () => {
            gemShapesDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const colorsBtn = document.querySelector('.colors-btn');
        const backColors = document.getElementById('backColors');

        colorsBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            colorsDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backColors.addEventListener('click', () => {
            colorsDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const birthBtn = document.querySelector('.birth-btn');
        const backBirth = document.getElementById('backBirth');

        birthBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            birthDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backBirth.addEventListener('click', () => {
            birthDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const ascBtn = document.querySelector('.asc-btn');
        const backAscendant = document.getElementById('backAscendant');

        ascBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            ascendantDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backAscendant.addEventListener('click', () => {
            ascendantDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const gemInsightBtn = document.querySelector('.gem-insight-btn');
        const backGemInsight = document.getElementById('backGemInsight');

        gemInsightBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            navaratnaDetails.style.display = 'none';

            gemInsightDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backGemInsight.addEventListener('click', () => {
            gemInsightDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const navaratnaBtn = document.querySelector('.navaratna-btn');
        const backNavaratna = document.getElementById('backNavaratna');

        navaratnaBtn.addEventListener('click', (e) => {
            e.preventDefault();

            gemstonesSection.style.display = 'none';
            miningBanner.style.display = 'none';
            gemTypesSection.style.display = 'none';
            birthSection.style.display = 'none';
            gemShapesSection.style.display = 'none';
            colorsBanner.style.display = 'none';
            ascendantSection.style.display = 'none';
            gemInsightSection.style.display = 'none';
            navaratnaSection.style.display = 'none';

            gemDetails.style.display = 'none';
            gemTypesDetails.style.display = 'none';
            birthDetails.style.display = 'none';
            gemShapesDetails.style.display = 'none';
            colorsDetails.style.display = 'none';
            ascendantDetails.style.display = 'none';
            gemInsightDetails.style.display = 'none';

            navaratnaDetails.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        backNavaratna.addEventListener('click', () => {
            navaratnaDetails.style.display = 'none';
            gemstonesSection.style.display = 'block';
            miningBanner.style.display = 'flex';
            gemTypesSection.style.display = 'block';
            birthSection.style.display = 'block';
            gemShapesSection.style.display = 'block';
            colorsBanner.style.display = 'flex';
            ascendantSection.style.display = 'block';
            gemInsightSection.style.display = 'flex';
            navaratnaSection.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        (function initStoryScrollAnimations() {
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

            const directionalContainers = document.querySelectorAll(
                '.gem-types-container, .gem-shapes-container, .birth-container, .ascendant-container, .navaratna-ring-container, .navaratna-split, .color-item'
            );

            directionalContainers.forEach((container) => {
                const children = Array.from(container.children);
                const imageCol = children.find((child) => /image|img/i.test(child.className));
                const contentCol = children.find((child) => /content|text/i.test(child.className));
                if (!imageCol || !contentCol) return;

                const imageFirst = imageCol.compareDocumentPosition(contentCol) & Node.DOCUMENT_POSITION_FOLLOWING;

                imageCol.classList.add('sa-hidden', imageFirst ? 'sa-ltr' : 'sa-rtl');
                contentCol.classList.add('sa-hidden', imageFirst ? 'sa-rtl' : 'sa-ltr');
                watch(imageCol);
                watch(contentCol);
            });

            const cardSelectors = '.details-card, .asc-card, .insight-card, .navaratna-split';
            document.querySelectorAll(cardSelectors).forEach((card, idx) => {
                card.classList.add('sa-hidden', 'sa-up');
                card.style.transitionDelay = `${(idx % 8) * 80}ms`;
                watch(card);
            });
        })();
    </script>
    <x-scroll-animations />
</body>

</html>




