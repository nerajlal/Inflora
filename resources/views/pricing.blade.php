@extends('layouts.app')

@section('title', 'Pricing - Inflora')

@section('content')
<style>
    /* Pricing Hero Section */
    .pricing-hero {
        padding: 150px 0 80px;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
    }

    .pricing-hero h1 {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 25px;
        line-height: 1.2;
        background: linear-gradient(135deg, #2c2c2c 0%, #d4af37 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
    }

    .pricing-hero p {
        font-size: 1.3rem;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
        text-align: center;
    }

    /* Pricing Plans */
    .pricing-plans {
        padding: 80px 0 120px;
        background: white;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .pricing-card {
        background: white;
        padding: 50px 40px;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        border: 2px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .pricing-card.premium {
        border: 2px solid #d4af37;
        box-shadow: 0 20px 60px rgba(212, 175, 55, 0.2);
        transform: scale(1.05);
    }

    .popular-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #d4af37, #f4d03f);
        color: white;
        padding: 8px 25px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .plan-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .plan-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 35px;
    }

    .plan-header h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .plan-header p {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 25px;
    }

    .price {
        font-size: 3rem;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .plan-features {
        list-style: none;
        margin-bottom: 40px;
    }

    .plan-features li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1rem;
        color: #444;
    }

    .plan-features li span {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-weight: bold;
        font-size: 12px;
    }

    .plan-button {
        width: 100%;
        padding: 18px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
    }

    .faq-grid {
        max-width: 800px;
        margin: 60px auto 0;
        display: grid;
        gap: 25px;
    }

    .faq-item {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.1);
    }

    .faq-item h3 {
        color: #2c2c2c;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .faq-item p {
        color: #666;
        line-height: 1.7;
    }

    /* Pricing CTA */
    .pricing-cta {
        padding: 80px 0;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        color: white;
        text-align: center;
    }

    .pricing-cta h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .pricing-cta p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }
</style>

<!-- Pricing Hero Section -->
<section class="pricing-hero">
    <div class="section-container">
        <div class="section-header reveal">
            <h1>Choose Your Influence Level</h1>
            <p>Select the perfect plan to amplify your influence and unlock premium opportunities with top-tier brands worldwide.</p>
        </div>
    </div>
</section>

<!-- Pricing Plans -->
<section class="pricing-plans">
    <div class="section-container">
        <div class="pricing-grid">
            <!-- Starter Plan -->
            <div class="pricing-card reveal">
                <div class="plan-header">
                    <div class="plan-icon" style="background: linear-gradient(135deg, #e8e8e8, #f5f5f5);">🌟</div>
                    <h3>Starter</h3>
                    <p>Perfect for emerging creators</p>
                    <div class="price">Free</div>
                    <p style="color: #666; font-size: 0.9rem;">Forever</p>
                </div>
                <ul class="plan-features">
                    <li><span style="background: #e8e8e8; color: #666;">✓</span> Basic profile setup</li>
                    <li><span style="background: #e8e8e8; color: #666;">✓</span> Access to basic campaigns</li>
                    <li><span style="background: #e8e8e8; color: #666;">✓</span> Standard analytics</li>
                    <li><span style="background: #e8e8e8; color: #666;">✓</span> Community support</li>
                    <li><span style="background: #e8e8e8; color: #666;">✓</span> Monthly payments</li>
                </ul>
                <a href="#" class="plan-button" style="background: #f5f5f5; color: #666; border: 2px solid #e8e8e8;">Get Started</a>
            </div>

            <!-- Premium Plan -->
            <div class="pricing-card premium reveal">
                <div class="popular-badge">Most Popular</div>
                <div class="plan-header">
                    <div class="plan-icon" style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">💎</div>
                    <h3>Premium</h3>
                    <p>For established influencers</p>
                    <div class="price">₹2,999</div>
                    <p style="color: #666; font-size: 0.9rem;">per month</p>
                </div>
                <ul class="plan-features">
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> Premium profile verification</li>
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> High-value brand campaigns</li>
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> Advanced analytics & insights</li>
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> Priority support</li>
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> Weekly payments</li>
                    <li><span style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white;">✓</span> Collaboration tools</li>
                </ul>
                <a href="#" class="plan-button" style="background: linear-gradient(135deg, #d4af37, #f4d03f); color: white; border: none; box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);">Start Premium</a>
            </div>

            <!-- Elite Plan -->
            <div class="pricing-card reveal">
                <div class="plan-header">
                    <div class="plan-icon" style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">👑</div>
                    <h3>Elite</h3>
                    <p>For top-tier influencers</p>
                    <div class="price">₹9,999</div>
                    <p style="color: #666; font-size: 0.9rem;">per month</p>
                </div>
                <ul class="plan-features">
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> VIP profile showcase</li>
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> Exclusive luxury campaigns</li>
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> Personal account manager</li>
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> Custom contract negotiation</li>
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> Instant payments</li>
                    <li><span style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white;">✓</span> Exclusive networking events</li>
                </ul>
                <a href="#" class="plan-button" style="background: linear-gradient(135deg, #2c2c2c, #1a1a1a); color: white; border: none; box-shadow: 0 6px 20px rgba(44, 44, 44, 0.3);">Join Elite</a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-container">
        <div class="section-header reveal">
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about our pricing and plans</p>
        </div>
        <div class="faq-grid">
            <div class="faq-item reveal">
                <h3>Can I switch plans anytime?</h3>
                <p>Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately, and we'll prorate your billing accordingly.</p>
            </div>
            <div class="faq-item reveal">
                <h3>What payment methods do you accept?</h3>
                <p>We accept all major credit cards, UPI, net banking, and digital wallets. All payments are processed securely through our encrypted payment gateway.</p>
            </div>
            <div class="faq-item reveal">
                <h3>Is there a long-term commitment?</h3>
                <p>No, all plans are month-to-month with no long-term contracts. You can cancel anytime with 30 days' notice.</p>
            </div>
            <div class="faq-item reveal">
                <h3>Do you offer refunds?</h3>
                <p>Yes, we offer a 14-day money-back guarantee for all paid plans. If you're not satisfied, we'll provide a full refund within the first 14 days.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing CTA -->
<section class="pricing-cta">
    <div class="section-container">
        <h2>Ready to Elevate Your Influence?</h2>
        <p>Start with our free plan and upgrade as you grow</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="#" style="background: white; color: #d4af37; padding: 18px 35px; border: none; border-radius: 50px; font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);">Start Free Trial</a>
            <a href="{{ route('contact') }}" style="background: transparent; color: white; padding: 18px 35px; border: 2px solid white; border-radius: 50px; font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease;">Contact Sales</a>
        </div>
    </div>
</section>
@endsection
