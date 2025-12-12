@extends('layouts.app')

@section('title', 'About Us - GlamNails')

@section('content')
    <div class="container py-5">
        
        <!-- Hero Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-3" style="color:#c63e70;">✨ About GlamNails ✨</h1>
            <p class="lead text-muted">Your trusted destination for premium nail care products</p>
        </div>

        <!-- About Brand Section -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg rounded-4 p-4 mb-4" style="background:#fff8fa;">
                    <h2 class="fw-bold mb-4" style="color:#c63e70;">
                        <i class="bi bi-heart-fill me-2"></i>Our Story
                    </h2>
                    <p class="text-secondary" style="line-height: 1.8; font-size: 1.05rem;">
                        Welcome to <strong style="color:#c63e70;">GlamNails</strong>, where beauty meets quality! We are passionate about providing you with the finest nail care products, accessories, and tools to help you express your unique style and creativity.
                    </p>
                    <p class="text-secondary" style="line-height: 1.8; font-size: 1.05rem;">
                        Founded with a vision to make professional-quality nail products accessible to everyone, GlamNails has become a trusted name in the beauty industry. We carefully curate our collection to ensure that every product meets our high standards of quality, safety, and innovation.
                    </p>
                    <p class="text-secondary" style="line-height: 1.8; font-size: 1.05rem;">
                        Whether you're a professional nail artist or someone who loves to pamper themselves at home, GlamNails has everything you need to create stunning nail art and maintain beautiful, healthy nails.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission & Values -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-4 p-4 h-100" style="background:#fff0f5;">
                    <h3 class="fw-bold mb-3" style="color:#c63e70;">
                        <i class="bi bi-bullseye me-2"></i>Our Mission
                    </h3>
                    <p class="text-secondary" style="line-height: 1.8;">
                        To empower individuals to express their creativity and enhance their natural beauty through premium nail care products that combine quality, innovation, and affordability.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-4 p-4 h-100" style="background:#fff0f5;">
                    <h3 class="fw-bold mb-3" style="color:#c63e70;">
                        <i class="bi bi-star-fill me-2"></i>Our Values
                    </h3>
                    <ul class="text-secondary" style="line-height: 2;">
                        <li><strong style="color:#c63e70;">Quality First:</strong> We never compromise on product quality</li>
                        <li><strong style="color:#c63e70;">Customer Care:</strong> Your satisfaction is our priority</li>
                        <li><strong style="color:#c63e70;">Innovation:</strong> We stay ahead with the latest trends</li>
                        <li><strong style="color:#c63e70;">Accessibility:</strong> Beauty products for everyone</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="card border-0 shadow-lg rounded-4 p-4 mb-5" style="background:#fff8fa;">
            <h2 class="fw-bold mb-4 text-center" style="color:#c63e70;">
                <i class="bi bi-check-circle-fill me-2"></i>Why Choose GlamNails?
            </h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="p-3">
                        <i class="bi bi-shield-check" style="font-size: 3rem; color: #dc769a;"></i>
                        <h5 class="fw-bold mt-3" style="color:#c63e70;">Premium Quality</h5>
                        <p class="text-muted">All products are carefully selected and tested for quality and safety.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3">
                        <i class="bi bi-truck" style="font-size: 3rem; color: #dc769a;"></i>
                        <h5 class="fw-bold mt-3" style="color:#c63e70;">Free Shipping</h5>
                        <p class="text-muted">Enjoy free shipping on all orders to make your shopping experience even better.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3">
                        <i class="bi bi-headset" style="font-size: 3rem; color: #dc769a;"></i>
                        <h5 class="fw-bold mt-3" style="color:#c63e70;">24/7 Support</h5>
                        <p class="text-muted">Our customer service team is always ready to assist you with any queries.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terms and Conditions Link -->
        <div class="card border-0 shadow-lg rounded-4 p-4 mb-4" style="background:#fff8fa;">
            <div class="text-center">
                <h2 class="fw-bold mb-3" style="color:#c63e70;">
                    <i class="bi bi-file-text-fill me-2"></i>Terms and Conditions
                </h2>
                <p class="text-secondary mb-4" style="line-height: 1.8;">
                    Please read our Terms and Conditions carefully before using our website and making a purchase. By using GlamNails, you agree to be bound by these terms.
                </p>
                <a href="{{ route('terms') }}" class="btn px-5 py-2 fw-bold"
                   style="background:#dc769a; color:white; border-radius:25px; font-size:1.1rem;">
                    <i class="bi bi-arrow-right-circle me-2"></i>Read Terms and Conditions
                </a>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-center">
            <div class="card border-0 shadow rounded-4 p-4" style="background:linear-gradient(135deg, #fff8fa 0%, #fff0f5 100%);">
                <h3 class="fw-bold mb-3" style="color:#c63e70;">Have Questions?</h3>
                <p class="text-muted mb-4">We're here to help! Reach out to us anytime.</p>
                <a href="{{ route('contact') }}" class="btn px-5 py-2 fw-bold"
                   style="background:#dc769a; color:white; border-radius:25px; font-size:1.1rem;">
                    <i class="bi bi-envelope me-2"></i>Contact Us
                </a>
            </div>
        </div>

    </div>
@endsection

