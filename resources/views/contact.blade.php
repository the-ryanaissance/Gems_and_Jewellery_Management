<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gems & Jewelry</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}"> 
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

        .contact-info-section {
            padding: 100px 8%;
            background: linear-gradient(to right, #faf7f2, #f3ece3);
        }

        .contact-container {
            max-width: 1200px;
            margin: auto;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-header h2 {
            font-size: 2.6rem;
            color: #bfa16a;
            margin-bottom: 15px;
        }

        .contact-header p {
            max-width: 600px;
            margin: auto;
            color: #666;
            line-height: 1.7;
        }

        

        .contact-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        

        .contact-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: 0.35s ease;
        }

        .contact-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        

        .contact-icon {
            width: 70px;
            height: 70px;
            background: #f6efe6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 20px;
            font-size: 26px;
            color: #bfa16a;
        }

        .contact-card h4 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .contact-card p {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
        }

        

        @media(max-width:900px) {
            .contact-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:600px) {
            .contact-cards {
                grid-template-columns: 1fr;
            }
        }

        .map-section {
            padding: 100px 8%;
            background: #f9f6f1;
        }

        .map-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .map-header h2 {
            font-size: 2.5rem;
            color: #bfa16a;
            margin-bottom: 10px;
        }

        .map-header p {
            max-width: 600px;
            margin: auto;
            color: #666;
            line-height: 1.7;
        }

        

        .map-container {
            width: 100%;
            height: 450px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .customer-contact-section {
            padding: 48px 8% 24px;
            background:
                radial-gradient(circle at top left, rgba(201, 169, 106, 0.16), transparent 26%),
                linear-gradient(135deg, #fffaf3 0%, #f7efe2 52%, #fffdf9 100%);
        }

        .customer-contact-shell {
            max-width: 1180px;
            margin: auto;
        }

        .customer-contact-panel {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(191, 161, 106, 0.22);
            border-radius: 28px;
            box-shadow: 0 20px 45px rgba(72, 49, 20, 0.08);
        }

        .customer-contact-panel {
            padding: 24px 24px 20px;
        }

        .customer-contact-head {
            margin-bottom: 16px;
        }

        .customer-contact-head h2 {
            margin: 0 0 6px;
            color: #b89250;
            font-size: 2rem;
        }

        .customer-contact-head p {
            margin: 0;
            color: #6d5842;
            max-width: 640px;
            line-height: 1.6;
        }

        .customer-contact-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .contact-form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .contact-form-field.full {
            grid-column: 1 / -1;
        }

        .contact-form-field label {
            font-weight: 600;
            color: #5c4936;
        }

        .contact-form-field input,
        .contact-form-field textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #e5d2b4;
            border-radius: 16px;
            background: #fffdf9;
            padding: 12px 14px;
            font: inherit;
            color: #2f2418;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .contact-form-field textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-form-field input:focus,
        .contact-form-field textarea:focus {
            outline: none;
            border-color: #c9a96a;
            box-shadow: 0 0 0 4px rgba(201, 169, 106, 0.14);
            transform: translateY(-1px);
        }

        .contact-form-field.invalid input,
        .contact-form-field.invalid textarea {
            border-color: #ca6b55;
            box-shadow: 0 0 0 4px rgba(202, 107, 85, 0.12);
        }

        .contact-field-error {
            min-height: 14px;
            font-size: 0.83rem;
            color: #b55440;
        }

        .customer-contact-actions {
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .customer-contact-submit {
            border: none;
            border-radius: 16px;
            padding: 12px 22px;
            background: linear-gradient(135deg, #c9a96a, #b28443);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(178, 132, 67, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .customer-contact-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(178, 132, 67, 0.24);
        }

        .customer-contact-feedback {
            display: none;
            margin-top: 14px;
            padding: 14px 16px;
            border-radius: 18px;
            line-height: 1.7;
            border: 1px solid transparent;
        }

        .customer-contact-feedback.show {
            display: block;
        }

        .customer-contact-feedback.success {
            background: #e8f5ee;
            border-color: #cce7d8;
            color: #215343;
        }

        .customer-contact-feedback.error {
            background: #fff1eb;
            border-color: #f0cec1;
            color: #9b4a37;
        }

        .contact-signin-note {
            padding: 90px 8% 20px;
            background: linear-gradient(135deg, #fffaf3 0%, #f7efe2 100%);
        }

        .contact-signin-card {
            max-width: 980px;
            margin: 0 auto;
            padding: 28px 30px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(191, 161, 106, 0.2);
            box-shadow: 0 18px 40px rgba(72, 49, 20, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .contact-signin-card h3 {
            margin: 0 0 8px;
            color: #2f2418;
            font-size: 1.8rem;
        }

        .contact-signin-card p {
            margin: 0;
            color: #6d5842;
            line-height: 1.7;
            max-width: 620px;
        }

        .contact-signin-card a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 22px;
            border-radius: 16px;
            background: linear-gradient(135deg, #d3b270, #c49b52);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
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

        @media(max-width: 720px) {
            .customer-contact-panel {
                padding: 26px 20px 22px;
            }

            .customer-contact-grid {
                grid-template-columns: 1fr;
            }

            .customer-contact-head h2 {
                font-size: 2rem;
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
<p>Get in Touch With Pinwntha Gems</p>
</div>
</section>
<section class="contact-info-section">
<div class="contact-container">
<div class="contact-header">
<h2>Get In Touch</h2>
<p>
We would love to hear from you. Reach out to us for inquiries,
custom jewelry requests, or any assistance you need.
</p>
</div>
<div class="contact-cards">
<div class="contact-card">
<div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
<h4>Our Address</h4>
<p>Head Office: JGGR+267, Pelmadulla, Rathnapura, Sri Lanka</p>
</div>
<div class="contact-card">
<div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
<h4>Contact Us</h4>
<p>Mobile: +(94) 71 281 8341 <br>Hotline: 1800 - 1102 <br>Mail: pinwanthagems@jewellery.com</p>
</div>
<div class="contact-card">
<div class="contact-icon"><i class="fas fa-clock"></i></div>
<h4>Opening Hours</h4>
<p>Monday - Saturday: 9:00 AM - 8:00 PM <br>Sunday: 10:00 AM - 6:00 PM</p>
</div>
</div>
</div>
</section>
@if (auth()->check() && auth()->user()->role === 'customer')
<section class="customer-contact-section">
<div class="customer-contact-shell">
<div class="customer-contact-panel">
<div class="customer-contact-head">
<div>
<h2>Contact Us</h2>
<p>Send us your questions, requests, or support messages and our team will review them carefully and get back to you as soon as possible.</p>
</div>
</div>
<form id="customerContactForm" novalidate>
<div class="customer-contact-grid">
<div class="contact-form-field" data-field="name">
<label for="contactCustomerName">Name</label>
<input id="contactCustomerName" name="name" type="text" value="{{ trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? '')) }}" required>
<div class="contact-field-error" data-error="name"></div>
</div>
<div class="contact-form-field" data-field="email">
<label for="contactCustomerEmail">Email</label>
<input id="contactCustomerEmail" name="email" type="email" value="{{ auth()->user()->email }}" required>
<div class="contact-field-error" data-error="email"></div>
</div>
<div class="contact-form-field" data-field="date">
<label for="contactCustomerDate">Date</label>
<input id="contactCustomerDate" name="date" type="date" required>
<div class="contact-field-error" data-error="date"></div>
</div>
<div class="contact-form-field" data-field="subject">
<label for="contactCustomerSubject">Subject</label>
<input id="contactCustomerSubject" name="subject" type="text" placeholder="Order help, gemstone advice, showroom question..." required>
<div class="contact-field-error" data-error="subject"></div>
</div>
<div class="contact-form-field full" data-field="message">
<label for="contactCustomerMessage">Message</label>
<textarea id="contactCustomerMessage" name="message" placeholder="Write your message clearly so the admin team can review and respond properly." required></textarea>
<div class="contact-field-error" data-error="message"></div>
</div>
</div>
<div class="customer-contact-actions">
<button class="customer-contact-submit" type="submit">Send Message</button>
</div>
<div id="customerContactFeedback" class="customer-contact-feedback"></div>
</form>
</div>
</div>
</section>
@else
<section class="contact-signin-note">
<div class="contact-signin-card">
<div>
<h3>Sign In To Send A Contact Message</h3>
<p>The customer contact form is available only after sign in. Once logged in as a customer, you can send messages directly to the admin contact inbox.</p>
</div>
<a href="{{ route('signin') }}">Sign In</a>
</div>
</section>
@endif
<section class="map-section">
<div class="map-header">
<h2>Visit Our Store</h2>
<p>
Discover our premium gemstone collection at our store location.
We welcome you to experience the brilliance in person.
</p>
</div>
<div class="map-container">
<iframe
src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31705.40923118667!2d80.50450991083984!3d6.625029300000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3eb7ce3878789%3A0xc84f354de9142419!2sPinwatta%20Gems!5e0!3m2!1sen!2slk!4v1772521193084!5m2!1sen!2slk"
allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
</iframe>
</div>
</section>
<x-footer />
<button id="scrollTopBtn">
<i class="fas fa-arrow-up"></i>
</button>
<script>
const customerContactForm = document.getElementById('customerContactForm');
if (customerContactForm) {
    customerContactForm.addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(customerContactForm);
        const routeURL = @json(route('contact-message.store'));

        try {
            const response = await fetch(routeURL, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                customerContactForm.reset();
                alert(result.message);
            } else {
                if (result.errors) {
                    let errorMessages = [];
                    for (const [field, messages] of Object.entries(result.errors)) {
                        errorMessages.push(...messages);
                    }
                    alert("Validation Errors:\n" + errorMessages.join("\n"));
                } else {
                    alert(result.message || 'Failed to send message.');
                }
            }
        } catch (err) {
            console.error('Contact form error:', err);
            alert('Network error. Please try again.');
        }
    });
}
</script>
<x-scroll-animations />
</body>
</html>
