<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inflora - Premium Influencer Platform')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 50%, #f8f8f8 100%);
            color: #2c2c2c;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            padding: 15px 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #d4af37, #f4d03f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        .nav-links a {
            text-decoration: none;
            color: #2c2c2c;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #d4af37;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #d4af37, #f4d03f);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .cta-btn {
            background: linear-gradient(135deg, #d4af37, #f4d03f);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        /* Common Styles */
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header h2 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #2c2c2c 0%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d4af37, #f4d03f);
            color: white;
            padding: 18px 35px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #2c2c2c;
            padding: 18px 35px;
            border: 2px solid #d4af37;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #d4af37, #f4d03f);
            color: white;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            color: #d4af37;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .footer-section p,
        .footer-section a {
            color: #ccc;
            text-decoration: none;
            line-height: 1.8;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #d4af37;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 30px;
            text-align: center;
            color: #999;
        }

        /* Smooth Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">Inflora</a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}#home">Home</a></li>
                <li><a href="{{ route('home') }}#features">Features</a></li>
                <li><a href="{{ route('home') }}#platform">Platform</a></li>
                <li><a href="{{ route('pricing') }}">Pricing</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <a href="#" class="cta-btn">Join as Influencer</a>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="section-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Influenceora</h3>
                    <p>The premium platform connecting elite influencers with luxury brands worldwide.</p>
                </div>
                <div class="footer-section">
                    <h3>For Creators</h3>
                    <p><a href="#">Join Platform</a></p>
                    <p><a href="#">Creator Resources</a></p>
                    <p><a href="#">Success Stories</a></p>
                    <p><a href="#">Growth Academy</a></p>
                </div>
                <div class="footer-section">
                    <h3>For Brands</h3>
                    <p><a href="#">Partner With Us</a></p>
                    <p><a href="#">Campaign Management</a></p>
                    <p><a href="#">Analytics Dashboard</a></p>
                    <p><a href="#">Brand Safety</a></p>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <p><a href="#">Help Center</a></p>
                    <p><a href="{{ route('contact') }}">Contact Us</a></p>
                    <p><a href="#">Privacy Policy</a></p>
                    <p><a href="#">Terms of Service</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Influenceora. All rights reserved by <a href="https://metora.in/" style="color:white">Metora.</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll reveal animation
        function reveal() {
            const reveals = document.querySelectorAll('.reveal');
            for (let i = 0; i < reveals.length; i++) {
                const windowHeight = window.innerHeight;
                const elementTop = reveals[i].getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add('active');
                }
            }
        }

        window.addEventListener('scroll', reveal);
        reveal(); // Initial check

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
