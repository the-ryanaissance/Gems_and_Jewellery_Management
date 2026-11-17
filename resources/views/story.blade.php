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

        

.gem-story-section {
    padding: 100px 8%;
    background: linear-gradient(to right, #fff8f0, #f7efe5);
}

.gem-story-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}



.gem-story-image img {
    width: 100%;
    border-radius: 25px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    transition: 0.5s;
}

.gem-story-image img:hover {
    transform: scale(1.03);
}



.gem-story-content {
    animation: fadeInUp 1s ease;
}

.story-small {
    color: #bfa16a;
    font-weight: 600;
    letter-spacing: 3px;
    font-size: 14px;
    text-transform: uppercase;
}

.gem-story-content h2 {
    font-size: 2.8rem;
    margin: 15px 0;
    color: #222;
}

.gem-story-content p {
    color: #555;
    line-height: 1.8;
    margin-bottom: 30px;
}



.story-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #bfa16a;
    color: white;
    padding: 14px 28px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.4s;
    box-shadow: 0 8px 20px rgba(191,161,106,0.3);
}

.story-btn:hover {
    background: #e6c67a;
    color: black;
    transform: translateY(-4px);
}



@media(max-width: 900px) {
    .gem-story-container {
        grid-template-columns: 1fr;
    }

    .gem-story-content h2 {
        font-size: 2rem;
    }
}



.gems-gallery{
    padding:80px 20px;
    background:#fff8f0;
}

.gallery-container{
    max-width:1200px;
    margin:auto;
}

.gallery-header{
    text-align:center;
    margin-bottom:50px;
}

.gallery-header h2{
    font-size:2.6rem;
    color:#bfa16a;
    margin-bottom:15px;
}

.gallery-header p{
    max-width:750px;
    margin:auto;
    font-size:1.05rem;
    color:#555;
    line-height:1.7;
}



.gallery-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}



.gallery-item{
    overflow:hidden;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.gallery-item img{
    width:100%;
    height:280px;
    object-fit:cover;
    transition:0.6s;
}



.gallery-item:hover img{
    transform:scale(1.15);
}



@media(max-width:768px){

.gallery-header h2{
    font-size:2rem;
}

.gallery-item img{
    height:220px;
}

}


.jewelry-story-section {
    padding: 95px 8%;
    background: linear-gradient(120deg, #ffffff 0%, #f8efe4 100%);
}

.jewelry-story-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 58px;
    align-items: center;
}

.jewelry-story-content {
    animation: fadeInUp 1s ease;
}

.jewelry-story-content .story-small {
    color: #bfa16a;
}

.jewelry-story-content h2 {
    font-size: 2.6rem;
    color: #222;
    margin: 14px 0 14px;
}

.jewelry-story-content p {
    color: #555;
    line-height: 1.85;
    margin-bottom: 30px;
}

.jewelry-story-image img {
    width: 100%;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    transition: transform 0.45s ease;
}

.jewelry-story-image img:hover {
    transform: scale(1.03);
}

@media(max-width: 900px) {
    .jewelry-story-container {
        grid-template-columns: 1fr;
    }

    .jewelry-story-content h2 {
        font-size: 2rem;
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

<body class="story-page">

    <x-navbar />

    
    <section id="about-header" class="about-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Gems & Jewellery</h1>
            <p>Discover the Beauty of Gems and Jewellery</p>
        </div>
    </section>

    
<section class="gem-story-section">

    <div class="gem-story-container">

        
        <div class="gem-story-image">
            <img src="{{ asset('images/main_website/web_story1.png') }}" alt="Gem Story">
        </div>

        
        <div class="gem-story-content">

            <span class="story-small">Our Heritage</span>

            <h2>Discover the Story Behind Gems</h2>

            <p>
                For thousands of years, Sri Lanka’s legendary gem lands, especially Ratnapura, 
                have gifted the world extraordinary treasures. In ancient history, kings and traders
                 valued these stones as symbols of wealth and protection. In astrology, gems are believed 
                 to attract luck, balance energy, and strengthen destiny. From the deep blue of Blue 
                 Sapphire to the fiery red of Ruby and the glowing charm of Cat's Eye, each gemstone 
                 carries unique color, meaning, and timeless beauty.

            </p>

            <a href="gemstory.blade.php" class="story-btn">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>


<section class="gems-gallery">
    <div class="gallery-container">

        <div class="gallery-header">
            <h2>Gemstone Gallery</h2>
            <p>
                Discover the natural brilliance and beauty of precious gemstones.
                Each gem reflects unique colors, light, and elegance that make
                gemstone jewelry timeless and admired worldwide.
            </p>
        </div>

        <div class="gallery-grid">

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_aprail.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_aug.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_dec.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_feb.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_gem1.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_gem5.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_jan.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_july.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_march.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_oct.png') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_nov.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_Virgo1.jpg') }}" alt="gem">
            </div>
        </div>

    </div>
</section>


<section class="jewelry-story-section">
    <div class="jewelry-story-container">
        <div class="jewelry-story-content">
            <span class="story-small">Craftsmanship Legacy</span>
            <h2>Discover the Story Behind Jewellery</h2>
            <p>
                Jewellery is more than adornment. It carries memory, identity, and artistry across generations.
                From hand-set gemstone rings to ceremonial heritage pieces, each design reflects culture, skill,
                and emotion. Explore how traditional craftsmanship blends with modern elegance in timeless
                jewellery creations.
            </p>
            <a href="{{ url('/juwelerystory') }}" class="story-btn">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="jewelry-story-image">
            <img src="{{ asset('images/main_website/web_j1.jpg') }}" alt="Jewellery Story">
        </div>
    </div>
</section>


<section class="gems-gallery">
    <div class="gallery-container">

        <div class="gallery-header">
            <h2>Jewellery Gallery</h2>
            <p>
                Discover the natural brilliance and beauty of elegant jewellery.
                Each piece reflects unique design, craftsmanship, and sophistication that make
                them timeless and admired worldwide.
            </p>
        </div>

        <div class="gallery-grid">

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j22.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j16.jpeg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j82.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j98.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j105.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j49.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j107.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j48.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j108.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j46.webp') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j19.jpg') }}" alt="gem">
            </div>

            <div class="gallery-item">
                <img src="{{ asset('images/main_website/web_j108.webp') }}" alt="gem">
            </div>
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

 

    </script>

    <x-scroll-animations />
</body>

</html>



