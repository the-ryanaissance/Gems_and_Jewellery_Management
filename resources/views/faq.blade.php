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


        

        .modern-faq {
            padding: 100px 8%;
            background: linear-gradient(to right, #faf7f2, #f3ece3);
        }

        .faq-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-small {
            color: #bfa16a;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 14px;
        }

        .faq-title h2 {
            font-size: 2.5rem;
            margin: 10px 0;
            color: #222;
        }

        .faq-title p {
            color: #666;
            max-width: 600px;
            margin: auto;
        }

        .faq-container {
            max-width: 900px;
            margin: auto;
        }

        .faq-card {
            background: #fff;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: 0.3s;
        }

        .faq-card:hover {
            transform: translateY(-5px);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            cursor: pointer;
        }

        .faq-question h4 {
            margin: 0;
            font-size: 1.05rem;
        }

        .faq-question i {
            color: #bfa16a;
            transition: 0.3s;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            padding: 0 25px;
        }

        .faq-answer p {
            padding: 15px 0 20px;
            color: #555;
            line-height: 1.6;
        }

        .faq-card.active .faq-answer {
            max-height: 200px;
        }

        .faq-card.active .faq-question i {
            transform: rotate(45deg);
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
            color: black;
            transform: translateY(-3px);
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
    </style>
</head>

<body>

   <x-navbar />
    
    <section id="about-header" class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Gems & Jewellery</h1>
            <p>FAQ</p>
        </div>
    </section>


    
    <section class="modern-faq">

        <div class="faq-title">
            <span class="faq-small">Need Help?</span>
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about our jewellery, services and policies.</p>
        </div>

        <div class="faq-container">
            @forelse ($faqEntries ?? collect() as $entry)
                <div class="faq-card">
                    <div class="faq-question">
                        <h4>{{ $entry->question }}</h4>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>{{ $entry->answer }}</p>
                    </div>
                </div>
            @empty
                <div class="faq-card">
                    <div class="faq-question">
                        <h4>No FAQs published yet</h4>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Please check back soon for updated answers.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </section>

    
    <button class="back-btn" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>

    
    <x-footer />

    
    <button id="scrollTopBtn">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        if (menuToggle && navUl) {
            menuToggle.addEventListener('click', () => {
                navUl.classList.toggle('show');
            });
        }

        document.querySelectorAll(".faq-question").forEach(question => {

            question.addEventListener("click", () => {

                const card = question.parentElement;

                document.querySelectorAll(".faq-card").forEach(item => {
                    if (item !== card) {
                        item.classList.remove("active");
                    }
                });

                card.classList.toggle("active");
            });

        });

    </script>

    <x-scroll-animations />
</body>

</html>



