@extends('layouts.app')

@section('title', 'Contact Us - GlamNails')

@section('content')
    @if(session('success'))
        <div class="alert alert-success text-center fw-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-5">
        <h1 class="text-center fw-bold mb-4">💌 Get in Touch with GlamNails</h1>
        <p class="text-center text-muted mb-5">
            Have questions, feedback, or just want to say hi? We’d love to hear from you!
        </p>

        <div class="row g-4 justify-content-center">
            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="contact-section bg-white rounded-4 p-4 shadow">
                    <h4 class="fw-bold mb-4">Send Us a Message</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control rounded-pill" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Message</label>
                            <textarea class="form-control rounded-4" rows="4" placeholder="Type your message..." required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 py-2 fw-semibold rounded-pill" style="background-color:#c63e70; color:white;">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-5">
                <div class="contact-info text-center p-4 rounded-4 shadow-sm" style="background-color:#ffe4ec;">
                    <h4 class="fw-bold mb-3" style="color:#c63e70;">💖 Connect With Us</h4>
                    <p class="text-muted mb-4">Stay updated with our latest designs, products, and nail trends!</p>

                    {{-- Social Media Icons --}}
                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <a href="https://www.instagram.com/" target="_blank" class="social-icon instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/" target="_blank" class="social-icon facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.pinterest.com/" target="_blank" class="social-icon pinterest"><i class="bi bi-pinterest"></i></a>
                        <a href="https://www.tiktok.com/" target="_blank" class="social-icon tiktok"><i class="bi bi-tiktok"></i></a>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-3">📞 Call or WhatsApp</h5>
                        <p class="text-muted">+92 312 4567890</p>

                        <h5 class="fw-bold mt-4 mb-3">📧 Email</h5>
                        <p class="text-muted">contact@glamnails.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   {{--icons styling--}}
    <style>
        .social-icon {
            font-size: 2rem;
            transition: all 0.3s ease;
            color: #c63e70;
        }
        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
            color: white !important;
            background-color: #c63e70;
            border-radius: 50%;
            padding: 8px 12px;
        }
        .instagram:hover { background-color: #E4405F; }
        .facebook:hover { background-color: #1877F2; }
        .pinterest:hover { background-color: #E60023; }
        .tiktok:hover { background-color: #010101; }
    </style>
@endsection
