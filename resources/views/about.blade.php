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

        
        .about-header {
            position: relative;
            width: 100%;
            height: 380px;
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
            color: #bfa16a;
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

        
        @media(max-width: 768px) {
            .story-container {
                flex-direction: column;
            }

            .story-images img {
                width: 100%;
            }
        }


.mission-section {
    padding: 100px 8%;
    background: linear-gradient(135deg, #fff8f0, #fdf0e3);
    position: relative;
    overflow: hidden;
}

.mission-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 80px;
    flex-wrap: wrap;
}


.mission-content {
    flex: 1;
    opacity: 0;
    transform: translateX(-50px);
    animation: slideInLeft 1s forwards;
    animation-delay: 0.3s;
}

.mission-content h2 {
    font-size: 2.7rem;
    color: #bfa16a;
    margin-bottom: 20px;
}

.mission-content p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
}


.mission-content ul {
    list-style: none;
    padding: 0;
}

.mission-content ul li {
    margin-bottom: 18px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 1.05rem;
    color: #333;
    transition: 0.3s ease;
}

.mission-content ul li:hover {
    transform: translateX(8px);
    color: #bfa16a;
}

.mission-content ul li .star {
    color: #bfa16a;
    font-size: 1.2rem;
    margin-top: 3px;
}


.mission-image {
    flex: 1;
    text-align: right;
    opacity: 0;
    transform: translateX(50px);
    animation: slideInRight 1s forwards;
    animation-delay: 0.5s;
}

.mission-image img {
    width: 100%;
    max-width: 480px;
    border-radius: 25px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    transition: 0.4s ease;
}

.mission-image img:hover {
    transform: scale(1.05);
}


@keyframes slideInLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}


@media(max-width: 768px) {
    .mission-container {
        flex-direction: column;
        text-align: center;
        gap: 50px;
    }

    .mission-image {
        text-align: center;
    }

    .mission-content ul li {
        justify-content: center;
    }
}


        

        #about-web {
            width: 100%;
            height: 100vh;
            padding: 0;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        #about-web .video video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }






        .finishing-touch {
            padding: 80px 5%;
            background: #f8f6f3;
            text-align: center;
        }

        .section-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #bfa16a;
        }

        .section-subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 50px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .collection-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            cursor: pointer;
        }

        .collection-card img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            transition: 0.5s ease;
        }

        .collection-card:hover img {
            transform: scale(1.08);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
        }

        .card-content {
            position: absolute;
            bottom: 25px;
            left: 0;
            right: 0;
            color: white;
        }

        .category {
            font-size: 12px;
            letter-spacing: 2px;
        }

        .card-content h4 {
            font-size: 18px;
            margin-top: 5px;
        }

        .card-descriptions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            text-align: center;
        }

        .card-descriptions h5 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .card-descriptions p {
            font-size: 13px;
            color: #777;
        }

        
        @media (max-width: 1024px) {

            .card-grid,
            .card-descriptions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {

            .card-grid,
            .card-descriptions {
                grid-template-columns: 1fr;
            }
        }



        

        .collection-banner {
            position: relative;
            width: 100%;
            height: 80vh;
            background: url('{{ asset('images/main_website/web_back4.jpg') }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        
        .collection-banner::before {
            content: "";
            position: absolute;
            inset: 0;
            background: inherit;
            background-size: cover;
            background-position: center;
            transform: scale(1);
            transition: transform 6s ease;
            z-index: 0;
        }

        .collection-banner:hover::before {
            transform: scale(1.1);
        }

        
        .collection-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        
        .collection-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            max-width: 800px;
            padding: 20px;
            animation: fadeUp 1s ease forwards;
        }

        .collection-subtitle {
            display: inline-block;
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .collection-title {
            font-size: 48px;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .collection-description {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        
        .collection-btn {
            display: inline-block;
            padding: 14px 36px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff;
            border: 2px solid #fff;
            text-decoration: none;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .collection-btn:hover {
            background: #fff;
            color: #000;
        }

        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        @media (max-width: 768px) {
            .collection-title {
                font-size: 32px;
            }

            .collection-description {
                font-size: 16px;
            }

            .collection-banner {
                height: 65vh;
            }
        }

        .why-choose-us {
            padding: 90px 5%;
            background: linear-gradient(to right, #f8f6f3, #ffffff);
            text-align: center;
        }

        .why-choose-us .section-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .why-choose-us .section-subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .feature-card {
            background: #fff;
            padding: 40px 25px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-card::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #c9a227, #e6c35c);
            top: 0;
            left: 0;
        }

        .icon {
            font-size: 28px;
            color: #bfa16a;
            margin-bottom: 20px;
        }

        .feature-card h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            color: #777;
        }

        
        @media (max-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

.gem-quality {
    padding: 110px 8%;
    background: linear-gradient(to right, #f9f6f1, #f4ede3); 
}

.quality-container {
    display: flex;
    align-items: center;
    gap: 70px;
    flex-wrap: wrap;
}


.quality-image {
    flex: 1;
    display: flex;
    justify-content: center;
}

.quality-image img {
    width: 100%;
    max-width: 750px; 
    height: 480px;  
    border-radius: 30px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.08);
    transition: 0.4s ease;
}

.quality-image img:hover {
    transform: scale(1.05);
}


.quality-content {
    flex: 1;
}

.quality-content h2 {
    font-size: 2.6rem;
    color: #bfa16a;
    margin-bottom: 20px;
    font-weight: 600;
}

.quality-content p {
    font-size: 1.05rem;
    line-height: 1.8;
    margin-bottom: 35px;
    color: #555;
}


.quality-points {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.point {
    padding: 15px 10px;
    transition: 0.3s ease;
}

.point:hover {
    transform: translateY(-5px);
}

.point h4 {
    font-size: 1.15rem;
    margin-bottom: 8px;
    color: #bfa16a;
}

.point p {
    font-size: 0.95rem;
    color: #666;
    line-height: 1.6;
}


@media(max-width: 768px){
    .quality-container{
        flex-direction: column;
        text-align: center;
        gap: 50px;
    }

    .quality-points{
        grid-template-columns: 1fr;
    }
}



        .our-team {
            padding: 90px 5%;
            background: #f9f7f4;
            
            text-align: center;
        }

        .our-team .section-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .our-team .section-subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 60px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .team-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: 0.4s ease;
            position: relative;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .team-img {
            overflow: hidden;
        }

        .team-img img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            transition: 0.5s ease;
        }

        .team-card:hover img {
            transform: scale(1.08);
        }

        .team-info {
            padding: 25px;
        }

        .team-info h4 {
            font-size: 18px;
            margin-bottom: 6px;
        }

        .team-info span {
            font-size: 13px;
            color: #bfa16a;
            
            letter-spacing: 1px;
        }

        
        @media (max-width: 1024px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .team-grid {
                grid-template-columns: 1fr;
            }
        }

        .faq-banner {
            position: relative;
            background: url('{{ asset('images/main_website/web_back2.jpg') }}') center/cover no-repeat;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .faq-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .faq-content {
            position: relative;
            max-width: 700px;
            padding: 20px;
            z-index: 2;
        }

        .faq-content h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .faq-content p {
            font-size: 15px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .faq-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(to right, #bfa16a, #e6c35c);
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .faq-btn:hover {
            opacity: 0.85;
            transform: translateY(-3px);
        }

        
        @media (max-width: 768px) {
            .faq-banner {
                height: 300px;
            }

            .faq-content h2 {
                font-size: 26px;
            }

            .faq-content p {
                font-size: 14px;
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

<body class="hero-page">

    <x-navbar />

    
    <section id="about-header" class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Gems & Jewellery</h1>
            <p>Discover Our Story, Craftsmanship, and Gem Heritage</p>
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

                <p>
                    Welcome to our journey! We started with a passion for quality and innovation.
                    Our goal is to create meaningful experiences for our customers through
                    dedication, creativity, and excellence. Discover how our story continues to grow.
                </p>

                <p>
                    Welcome to our journey! We started with a passion for quality and innovation.
                    Our goal is to create meaningful experiences for our customers through
                    dedication, creativity, and excellence. Discover how our story continues to grow.
                </p>

                <p>
                    Welcome to our journey! We started with a passion for quality and innovation.
                    Our goal is to create meaningful experiences for our customers through
                    dedication, creativity, and excellence. Discover how our story continues to grow.
                </p>

            </div>

        </div>
    </section>

    
    <section class="mission-section">
    <div class="mission-container">

        
        <div class="mission-content">
            <h2>Our Mission</h2>
            <p>
                We are dedicated to crafting timeless jewelry pieces that blend elegance,
                quality, and innovation. Every creation reflects our passion for beauty
                and commitment to excellence.
            </p>

            <ul>
                <li><span class="star">★</span> Handcrafted with precision and care</li>
                <li><span class="star">★</span> Ethically sourced premium materials</li>
                <li><span class="star">★</span> Timeless luxury designs</li>
                <li><span class="star">★</span> Sustainable and responsible production</li>
                <li><span class="star">★</span> Customer-first experience approach</li>
                <li><span class="star">★</span> Innovation blended with tradition</li>
            </ul>
        </div>

        
        <div class="mission-image">
            <img src="{{ asset('images/main_website/about_mission.jpg') }}" alt="Our Mission">
        </div>

    </div>
</section>

    

    <section id="about-web" class="section-p1">
        <div class="video">
            <video autoplay muted loop src="{{ asset('images/main_website/web_video.mp4') }}"></video>
        </div>
    </section>

    <section class="finishing-touch">
        <div class="container">
            <h2 class="section-title">The Finishing Touch</h2>
            <p class="section-subtitle">
                Our collections represent an assemblage of diverse jewelry pieces united by a common theme.
            </p>

            <div class="card-grid">

                
                <div class="collection-card">
                    <img src="{{ asset('images/main_website/web_ft1.jpg') }}" alt="Rings">
                    <div class="overlay"></div>
                    <div class="card-content">
                        <span class="category">RINGS</span>
                        <h4>One-Of-A-Kinds</h4>
                    </div>
                </div>

                
                <div class="collection-card">
                    <img src="{{ asset('images/main_website/web_ft2.jpg') }}" alt="Necklaces">
                    <div class="overlay"></div>
                    <div class="card-content">
                        <span class="category">NECKLACES</span>
                        <h4>High Tide Looks</h4>
                    </div>
                </div>

                
                <div class="collection-card">
                    <img src="{{ asset('images/main_website/web_ft3.jpg') }}" alt="Earrings">
                    <div class="overlay"></div>
                    <div class="card-content">
                        <span class="category">EARRINGS</span>
                        <h4>New Organic Dôme</h4>
                    </div>
                </div>

                
                <div class="collection-card">
                    <img src="{{ asset('images/main_website/web_ft4.jpg') }}" alt="Necklaces">
                    <div class="overlay"></div>
                    <div class="card-content">
                        <span class="category">NECKLACES</span>
                        <h4>The Tiffany Icons</h4>
                    </div>
                </div>

            </div>

            
            <div class="card-descriptions">
                <div>
                    <h5>One-Of-A-Kinds</h5>
                    <p>Featuring unique and hand-sourced gemstones from all over the world.</p>
                </div>

                <div>
                    <h5>High Tide Looks</h5>
                    <p>Featuring unique and hand-sourced gemstones from all over the world.</p>
                </div>

                <div>
                    <h5>New Organic Dôme</h5>
                    <p>From solid gold staples to diamond jewelry, browse our most-loved pieces.</p>
                </div>

                <div>
                    <h5>The Tiffany Icons</h5>
                    <p>The Flora Necklace is a symbol of serenity, and alignment with the pace of nature.</p>
                </div>
            </div>

        </div>
    </section>

    
    <section class="collection-banner">
        <div class="collection-overlay"></div>

        <div class="collection-content">
            <span class="collection-subtitle">Gem & Jewellery Collection</span>

            <h1 class="collection-title">
                Discover Your Signature Sparkle with New Collection
            </h1>

            <p class="collection-description">
                Exceptional Handcrafted Design to Enhance The Magnificent Glow
            </p>

            <a href="{{ route('jewellery') }}" class="collection-btn">
                Shop Now
            </a>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-subtitle">
                Where craftsmanship meets timeless elegance.
            </p>

            <div class="features-grid">

                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Premium Quality</h4>
                    <p>Hand-selected gemstones and ethically sourced gold crafted to perfection.</p>
                </div>

                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4>Fast & Secure Shipping</h4>
                    <p>Reliable delivery with insured packaging to protect your precious pieces.</p>
                </div>

                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Certified Craftsmanship</h4>
                    <p>Each product is quality-checked and certified for authenticity and durability.</p>
                </div>

                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Customer Support</h4>
                    <p>Our dedicated team is always ready to assist you anytime, anywhere.</p>
                </div>

            </div>
        </div>
    </section>

    

    <section class="gem-quality">
    <div class="quality-container">

        
        <div class="quality-image">
            <img src="{{ asset('images/main_website/web_may.jpg') }}" alt="Premium Gem Quality">
        </div>

        
        <div class="quality-content">
            <h2>The Quality of Our Gems</h2>
            <p>
                Our gemstones are carefully selected for their brilliance, purity, and timeless beauty.
                Each piece is inspected to ensure exceptional craftsmanship and authenticity.
            </p>

            <div class="quality-points">
                <div class="point">
                    <h4>Ethically Sourced</h4>
                    <p>Responsibly mined gemstones from trusted global suppliers.</p>
                </div>

                <div class="point">
                    <h4>Certified Authenticity</h4>
                    <p>Verified grading and documentation with every purchase.</p>
                </div>

                <div class="point">
                    <h4>Exceptional Clarity</h4>
                    <p>Selected based on brilliance, symmetry, and precision cut.</p>
                </div>

                <div class="point">
                    <h4>Long-Lasting Durability</h4>
                    <p>Carefully tested to maintain shine for generations.</p>
                </div>
            </div>
        </div>

    </div>
</section>
    <section class="our-team">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <p class="section-subtitle">
                The creative minds behind our timeless collections.
            </p>

            <div class="team-grid">

                
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/main_website/web_t1.jfif') }}" alt="Mark Jance">
                    </div>
                    <div class="team-info">
                        <h4>Mark Jance</h4>
                        <span>CEO - Founder</span>
                    </div>
                </div>

                
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/main_website/web_t2.jfif') }}" alt="Aviana Plummer">
                    </div>
                    <div class="team-info">
                        <h4>Aviana Plummer</h4>
                        <span>CEO - Founder</span>
                    </div>
                </div>

                
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/main_website/Feedback (4).jpg') }}" alt="Bradon Wilkeson">
                    </div>
                    <div class="team-info">
                        <h4>Bradon Wilkeson</h4>
                        <span>Supervisor</span>
                    </div>
                </div>

                
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/main_website/web_t4.jfif') }}" alt="Aviana Plummer">
                    </div>
                    <div class="team-info">
                        <h4>Aviana Plummer</h4>
                        <span>Designer</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="faq-banner">
        <div class="faq-overlay"></div>

        <div class="faq-content">
            <h2>Frequently Asked Questions</h2>
            <p>
                Find answers to the most common questions about our jewelry,
                craftsmanship, shipping, and policies.
            </p>
            <a href="{{ route('faq') }}" class="faq-btn">Explore FAQs</a>
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

        const video = document.getElementById("promoVideo");
        if (video) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        video.play().catch(() => { });
                    } else {
                        video.pause();
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(video);
        }

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
            const revealObserver = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.18, rootMargin: "0px 0px -8% 0px" });

            let idx = 0;
            targets.forEach((el) => {
                if (el.classList.contains("about-header")) return;
                el.classList.add("section-reveal");
                el.style.setProperty("--reveal-delay", `${(idx % 4) * 80}ms`);
                revealObserver.observe(el);
                idx++;
            });
        });

    </script>

    <x-scroll-animations />
</body>

</html>







