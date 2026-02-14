@extends('layouts.app')

@section('title', 'Inflora - Unite All Influencers Under One Platform')

@section('content')
<style>
    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #2c2c2c 0%, #d4af37 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-content p {
        font-size: 1.3rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.8;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .hero-visual {
        position: relative;
        height: 500px;
    }

    .floating-card {
        position: absolute;
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.2);
        animation: float 6s ease-in-out infinite;
    }

    .floating-card:nth-child(1) {
        top: 0;
        left: 0;
        animation-delay: 0s;
    }

    .floating-card:nth-child(2) {
        top: 100px;
        right: 0;
        animation-delay: 2s;
    }

    .floating-card:nth-child(3) {
        bottom: 50px;
        left: 50px;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .influencer-card {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .influencer-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 18px;
    }

    .influencer-info h4 {
        color: #2c2c2c;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .influencer-info p {
        color: #666;
        font-size: 0.9rem;
    }

    /* Features Section */
    .features {
        padding: 120px 0;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
    }

    .feature-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #d4af37, #f4d03f);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        font-size: 30px;
        color: white;
    }

    .feature-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c2c2c;
    }

    .feature-card p {
        color: #666;
        line-height: 1.7;
    }

    /* Stats Section */
    .stats {
        padding: 100px 0;
        background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 60px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #ccc;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Platform Section */
    .platform {
        padding: 120px 0;
        background: white;
    }

    .platform-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .platform-text h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #2c2c2c 0%, #d4af37 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .platform-text p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.8;
    }

    .platform-features {
        list-style: none;
        margin: 30px 0;
    }

    .platform-features li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1.1rem;
        color: #444;
    }

    .platform-features li::before {
        content: '✓';
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        color: white;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-weight: bold;
        font-size: 14px;
    }

    .platform-visual {
        position: relative;
        height: 450px;
        background: linear-gradient(135deg, #f8f8f8, #ffffff);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }

    .platform-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* CTA Section */
    .cta-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        color: white;
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .cta-section p {
        font-size: 1.3rem;
        margin-bottom: 40px;
        opacity: 0.9;
    }

    .cta-button {
        background: white;
        color: #d4af37;
        padding: 20px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .hero-container {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .platform-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-container">
        <div class="hero-content fade-in">
            <h1>Unite All Influencers Under One Platform</h1>
            <p>Connect, collaborate, and grow with the world's most exclusive influencer marketplace. Where premium creators meet premium opportunities.</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">Join as Influencer</a>
                <a href="#" class="btn-secondary">Partner with Us</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="floating-card">
                <div class="influencer-card">
                    <div class="influencer-avatar">SK</div>
                    <div class="influencer-info">
                        <h4>Sarah Kim</h4>
                        <p>Fashion & Lifestyle</p>
                    </div>
                </div>
            </div>
            <div class="floating-card">
                <div class="influencer-card">
                    <div class="influencer-avatar">MJ</div>
                    <div class="influencer-info">
                        <h4>Mike Johnson</h4>
                        <p>Tech Reviewer</p>
                    </div>
                </div>
            </div>
            <div class="floating-card">
                <div class="influencer-card">
                    <div class="influencer-avatar">AL</div>
                    <div class="influencer-info">
                        <h4>Anna Lopez</h4>
                        <p>Travel Creator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="section-container">
        <div class="section-header reveal">
            <h2>Premium Features for Elite Creators</h2>
            <p>Everything you need to elevate your influence and monetize your content at the highest level</p>
        </div>
        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon">🎯</div>
                <h3>Smart Brand Matching</h3>
                <p>AI-powered algorithms connect you with brands that perfectly align with your audience and values, ensuring authentic partnerships.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">💎</div>
                <h3>Premium Campaign</h3>
                <p>Exclusive access to high-budget campaigns and luxury brand partnerships reserved for top-tier influencers.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">📊</div>
                <h3>Advanced Analytics</h3>
                <p>Comprehensive insights into your performance, audience demographics, and earning potential with detailed reporting.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">🤝</div>
                <h3>Collaboration Hub</h3>
                <p>Connect and collaborate with other premium influencers, create joint campaigns, and expand your network.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">💰</div>
                <h3>Instant Payments</h3>
                <p>Fast, secure payments with multiple payout options and transparent fee structure. Get paid what you're worth.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">🎓</div>
                <h3>Growth Academy</h3>
                <p>Exclusive masterclasses, workshops, and one-on-one mentoring from industry experts to scale your influence.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="section-container">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <div class="stat-number">50+</div>
                <div class="stat-label">Active Influencers</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number">200+</div>
                <div class="stat-label">Brand Partnerships</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number">₹100000+</div>
                <div class="stat-label">Creator Earnings</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
        </div>
    </div>
</section>

<!-- Platform Section -->
<section class="platform" id="platform">
    <div class="section-container">
        <div class="platform-content">
            <div class="platform-text reveal">
                <h2>The Ultimate Influencer Ecosystem</h2>
                <p>Influenceora brings together creators, brands, and opportunities in one seamless, premium experience designed for the modern influencer economy.</p>
                <ul class="platform-features">
                    <li>Multi-platform content management</li>
                    <li>Real-time campaign tracking</li>
                    <li>Automated contract generation</li>
                    <li>Content collaboration tools</li>
                    <li>Revenue optimization insights</li>
                    <li>24/7 premium support</li>
                </ul>
                <a href="#" class="btn-primary">Explore Platform</a>
            </div>
            <div class="platform-visual reveal">
                <img src="{{ asset('images/demo.jpeg') }}" alt="Platform Preview">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="section-container">
        <h2>Ready to Elevate Your Influence?</h2>
        <p>Join thousands of premium creators who've transformed their passion into profit</p>
        <a href="#" class="cta-button">Start Your Premium Journey</a>
    </div>
</section>

<script>
    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
            const increment = target / 100;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                if (counter.textContent.includes('K')) {
                    counter.textContent = Math.floor(current) + 'K+';
                } else if (counter.textContent.includes('M')) {
                    counter.textContent = Math.floor(current) + 'M+';
                } else if (counter.textContent.includes('%')) {
                    counter.textContent = Math.floor(current) + '%';
                } else if (counter.textContent.includes('₹')) {
                    counter.textContent = '₹' + Math.floor(current) + '+';
                } else {
                    counter.textContent = '$' + Math.floor(current) + 'M+';
                }
            }, 20);
        });
    }

    // Trigger counter animation when stats section is visible
    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });
        observer.observe(statsSection);
    }
</script>
@endsection
