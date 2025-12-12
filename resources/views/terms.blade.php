@extends('layouts.app')

@section('title', 'Terms and Conditions - GlamNails')

@section('content')
    <div class="container py-5">
        
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-3" style="color:#c63e70;">
                <i class="bi bi-file-text-fill me-2"></i>Terms and Conditions
            </h1>
            <p class="lead text-muted">Please read these terms carefully before using our website</p>
            <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-sm mt-2">
                <i class="bi bi-arrow-left me-1"></i>Back to About Us
            </a>
        </div>

        <!-- Terms Content -->
        <div class="card border-0 shadow-lg rounded-4 p-4 mb-4" style="background:#fff8fa;">
            
            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">1. Acceptance of Terms</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    By accessing and using the GlamNails website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to these terms, please do not use our website.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">2. Use License</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    Permission is granted to temporarily download one copy of the materials on GlamNails' website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                </p>
                <ul class="text-secondary" style="line-height: 2;">
                    <li>Modify or copy the materials</li>
                    <li>Use the materials for any commercial purpose or for any public display</li>
                    <li>Attempt to reverse engineer any software contained on GlamNails' website</li>
                    <li>Remove any copyright or other proprietary notations from the materials</li>
                </ul>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">3. Product Information</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    We strive to provide accurate product descriptions, images, and pricing. However, we do not warrant that product descriptions or other content on this site is accurate, complete, reliable, current, or error-free. If a product offered by GlamNails is not as described, your sole remedy is to return it in unused condition.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">4. Pricing and Payment</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    All prices are listed in PKR (Pakistani Rupees) and are subject to change without notice. We reserve the right to modify prices at any time. Payment must be received before order processing and shipment. We accept various payment methods as displayed during checkout.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">5. Shipping and Delivery</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    We offer free shipping on all orders. Delivery times may vary depending on your location. GlamNails is not responsible for delays caused by shipping carriers or customs. We will provide tracking information once your order ships. Please ensure your shipping address is correct as we are not responsible for orders shipped to incorrect addresses provided by the customer.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">6. Returns and Refunds</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    If you are not satisfied with your purchase, you may return unused items within 7 days of delivery for a full refund. Items must be in their original packaging and condition. Return shipping costs are the responsibility of the customer unless the product is defective or incorrect. To initiate a return, please contact our customer service team.
                </p>
                <p class="text-secondary" style="line-height: 1.8;">
                    Refunds will be processed within 5-7 business days after we receive and inspect the returned items. Refunds will be issued to the original payment method used for the purchase.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">7. Privacy Policy</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    Your privacy is important to us. We collect and use your personal information only to process orders and improve your shopping experience. We do not sell or share your information with third parties. We implement appropriate security measures to protect your personal information. Please review our Privacy Policy for more details on how we handle your data.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">8. Intellectual Property</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    All content on this website, including but not limited to text, graphics, logos, images, and software, is the property of GlamNails and is protected by copyright and other intellectual property laws. You may not reproduce, distribute, or create derivative works from any content on this website without our express written permission.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">9. Limitation of Liability</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    In no event shall GlamNails or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on GlamNails' website, even if GlamNails or a GlamNails authorized representative has been notified orally or in writing of the possibility of such damage.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">10. User Accounts</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    If you create an account on our website, you are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account. We reserve the right to refuse service, terminate accounts, or remove content at our sole discretion.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">11. Prohibited Uses</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    You may not use our website:
                </p>
                <ul class="text-secondary" style="line-height: 2;">
                    <li>In any way that violates any applicable law or regulation</li>
                    <li>To transmit any malicious code or viruses</li>
                    <li>To impersonate or attempt to impersonate GlamNails or any employee or affiliate</li>
                    <li>To engage in any automated use of the system that interferes with the website's operation</li>
                </ul>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">12. Modifications</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    GlamNails may revise these terms of service at any time without notice. By using this website, you are agreeing to be bound by the then current version of these terms of service. We encourage you to review these terms periodically for any changes.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">13. Governing Law</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    These terms and conditions are governed by and construed in accordance with the laws of Pakistan. Any disputes relating to these terms will be subject to the exclusive jurisdiction of the courts of Pakistan.
                </p>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3" style="color:#c63e70;">14. Contact Information</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    If you have any questions about these Terms and Conditions, please contact us through our <a href="{{ route('contact') }}" style="color:#c63e70; text-decoration: none; font-weight: bold;">contact page</a> or email us at <strong style="color:#c63e70;">contact@glamnails.com</strong>. Our customer service team is available to assist you with any inquiries.
                </p>
            </div>

            <div class="alert alert-info mt-4 rounded-3" style="background:#fff0f5; border: 2px solid #dc769a;">
                <p class="mb-0 text-center">
                    <strong style="color:#c63e70;">Last Updated:</strong> {{ date('F d, Y') }}
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="text-center">
            <a href="{{ route('about') }}" class="btn px-5 py-2 fw-bold" style="background:#dc769a; color:white; border-radius:25px; font-size:1.1rem;">
                <i class="bi bi-arrow-left me-2"></i>Back to About Us
            </a>
        </div>

    </div>
@endsection

