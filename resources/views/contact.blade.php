@extends('layouts.app')

@section('title', 'Contact Us - Inflora')

@section('content')
<style>
    /* Contact Hero Section */
    .contact-hero {
        padding: 150px 0 80px;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
    }

    .contact-hero-content h1 {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 25px;
        line-height: 1.2;
        background: linear-gradient(135deg, #2c2c2c 0%, #d4af37 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
    }

    .contact-hero-content p {
        font-size: 1.3rem;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
        text-align: center;
    }

    /* Contact Section */
    .contact-section {
        padding: 80px 0;
        background: white;
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 80px;
        align-items: start;
    }

    /* Contact Form */
    .contact-form-wrapper {
        background: #fafafa;
        padding: 50px;
        border-radius: 20px;
        border: 1px solid rgba(212, 175, 55, 0.1);
    }

    .contact-form-header {
        margin-bottom: 40px;
    }

    .contact-form-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #2c2c2c;
    }

    .contact-form-header p {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .contact-form {
        display: grid;
        gap: 25px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 8px;
        color: #2c2c2c;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 15px;
        border: 2px solid #e8e8e8;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #d4af37;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Contact Info */
    .contact-info {
        display: grid;
        gap: 30px;
    }

    .contact-card {
        background: white;
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.1);
        text-align: center;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.15);
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 24px;
    }

    .contact-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c2c2c;
    }

    .contact-card p {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }

    /* FAQ Section */
    .faq-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 60px;
    }

    .faq-item {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.15);
    }

    .faq-item h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c2c2c;
    }

    .faq-item p {
        color: #666;
        line-height: 1.7;
    }

    /* Mobile Responsiveness */
    @media (max-width: 992px) {
        .contact-hero {
            padding: 120px 0 60px;
        }

        .contact-hero-content h1 {
            font-size: 2.6rem;
        }

        .contact-content {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .contact-info {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 100px 0 50px;
        }

        .contact-hero-content h1 {
            font-size: 2rem;
        }

        .contact-hero-content p {
            font-size: 1.1rem;
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .contact-form-wrapper {
            padding: 30px;
        }

        .contact-form-header h2 {
            font-size: 1.8rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .contact-info {
            grid-template-columns: 1fr;
        }

        .faq-section {
            padding: 60px 0;
        }

        .faq-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .contact-hero {
            padding: 80px 0 40px;
        }

        .contact-hero-content h1 {
            font-size: 1.7rem;
        }

        .contact-hero-content p {
            font-size: 1rem;
        }

        .contact-form-wrapper {
            padding: 25px 20px;
        }

        .contact-form-header h2 {
            font-size: 1.5rem;
        }

        .contact-form-header p {
            font-size: 1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px;
            font-size: 0.95rem;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .contact-card h3 {
            font-size: 1.1rem;
        }

        .contact-card p {
            font-size: 0.9rem;
        }

        .faq-item {
            padding: 25px 20px;
        }

        .faq-item h3 {
            font-size: 1.1rem;
        }
    }
</style>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="section-container">
        <div class="contact-hero-content reveal">
            <h1>Get In Touch</h1>
            <p>Ready to elevate your influence? Let's connect and explore how Influenceora can transform your creative journey.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="section-container">
        <div class="contact-content">
            <div class="contact-form-wrapper reveal">
                <div class="contact-form-header">
                    <h2>Send Us a Message</h2>
                    <p>Have questions about our platform? Want to discuss partnership opportunities? We'd love to hear from you.</p>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>
                            @error('firstName')
                                <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
                            @error('lastName')
                                <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="userType">I am a...</label>
                        <select id="userType" name="userType" required>
                            <option value="">Select your role</option>
                            <option value="influencer" {{ old('userType') == 'influencer' ? 'selected' : '' }}>Content Creator/Influencer</option>
                            <option value="brand" {{ old('userType') == 'brand' ? 'selected' : '' }}>Brand Representative</option>
                            <option value="agency" {{ old('userType') == 'agency' ? 'selected' : '' }}>Agency/Manager</option>
                            <option value="other" {{ old('userType') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('userType')
                            <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required placeholder="Tell us about your goals, questions, or how we can help you succeed...">{{ old('message') }}</textarea>
                        @error('message')
                            <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info reveal">
                <div class="contact-card">
                    <div class="contact-icon">📧</div>
                    <h3>Email Us</h3>
                    <p>hello@influenceora.com</p>
                    <p>partnerships@influenceora.com</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">📱</div>
                    <h3>Call Us</h3>
                    <p>+91 9876543210</p>
                    <p>Mon - Fri, 9 AM - 6 PM IST</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">🌍</div>
                    <h3>Visit Us</h3>
                    <p>Influenceora HQ</p>
                    <p>Kollam, Kerala, India</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">💬</div>
                    <h3>Social Media</h3>
                    <p>Follow us for updates</p>
                    <p>@influenceora</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-container">
        <div class="section-header reveal">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to common questions about our platform</p>
        </div>
        
        <div class="faq-grid">
            <div class="faq-item reveal">
                <h3>How do I join as an influencer?</h3>
                <p>Simply click "Join as Influencer" and complete our application process. We review each application to ensure quality partnerships.</p>
            </div>
            
            <div class="faq-item reveal">
                <h3>What are the requirements to join?</h3>
                <p>We look for engaged audiences, quality content, and authentic brand alignment. Minimum follower counts vary by platform and niche.</p>
            </div>
            
            <div class="faq-item reveal">
                <h3>How do payments work?</h3>
                <p>We offer secure, fast payments with multiple payout options including bank transfer, PayPal, and digital wallets.</p>
            </div>
            
            <div class="faq-item reveal">
                <h3>Can brands contact me directly?</h3>
                <p>Yes, our platform facilitates direct communication between brands and influencers while maintaining privacy and security.</p>
            </div>
        </div>
    </div>
</section>
@endsection
