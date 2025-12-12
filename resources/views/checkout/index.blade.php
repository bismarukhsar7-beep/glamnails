@extends('layouts.app')

@section('title', 'Checkout - GlamNails')

@section('content')
    <div class="container py-5">

        <h2 class="text-center mb-5 fw-bold" style="color:#c63e70;">✨ Checkout ✨</h2>

        @if (!$cartItems || count($cartItems) === 0)
            <div class="alert alert-info text-center rounded-4 p-4" style="background:#fff8fa; border: 2px solid #dc769a;">
                <i class="bi bi-cart-x" style="font-size: 3rem; color: #c63e70;"></i>
                <h4 class="mt-3 mb-3" style="color:#c63e70;">Your cart is empty</h4>
                <a href="{{ route('products.index') }}" class="btn" style="background:#dc769a;color:white;border-radius:25px; padding: 10px 30px;">
                    Continue Shopping
                </a>
            </div>
            @return
        @endif

        <div class="row g-4">

            {{-- LEFT: Order Summary --}}
            <div class="col-md-6">
                <div class="card border-0 shadow rounded-4 p-4" style="background:#fff8fa;">
                    <h4 class="fw-bold mb-4" style="color:#c63e70;">
                        <i class="bi bi-bag-check me-2"></i>Order Summary
                    </h4>

                    <div class="mb-4 order-summary-scroll" style="max-height: 400px; overflow-y: auto;">
                        @foreach ($cartItems as $item)
                            @php $product = $item['product']; @endphp

                            <div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:white; border: 1px solid #f0d3cf;">
                                <img src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}"
                                     style="width:90px;height:90px;object-fit:cover;border-radius:12px;">

                                <div class="ms-3 flex-grow-1">
                                    <h6 class="fw-bold mb-1" style="color:#c63e70;">{{ $product->name }}</h6>
                                    <p class="text-muted small mb-1">Category: {{ $product->category }}</p>
                                    <p class="mb-1"><strong>Qty:</strong> {{ $item['quantity'] }}</p>
                                    <p class="mb-0 fw-bold" style="color:#c63e70;">PKR {{ number_format($item['subtotal']) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-top pt-3 mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold">PKR {{ number_format($total) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Shipping:</span>
                            <span class="fw-bold text-success">Free</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <h5 class="mb-0 fw-bold" style="color:#c63e70;">Total:</h5>
                            <h4 class="mb-0 fw-bold" style="color:#c63e70;">PKR {{ number_format($total) }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Checkout Form --}}
            <div class="col-md-6">
                <div class="card border-0 shadow rounded-4 p-4" style="background:#fff8fa;">
                    <h4 class="fw-bold mb-4" style="color:#c63e70;">
                        <i class="bi bi-person-lines-fill me-2"></i>Billing Details
                    </h4>

                    <form action="{{ route('checkout.placeOrder') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color:#c63e70;">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-pill" placeholder="Enter your full name" required
                                   style="border-color:#dc769a;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color:#c63e70;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-pill" placeholder="your.email@example.com" required
                                   style="border-color:#dc769a;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color:#c63e70;">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control rounded-pill" placeholder="+92 300 1234567" required
                                   style="border-color:#dc769a;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color:#c63e70;">Shipping Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control rounded-3" rows="4" 
                                      placeholder="Enter your complete shipping address" required
                                      style="border-color:#dc769a;"></textarea>
                        </div>

                        <button type="submit"
                                class="btn w-100 py-3 fw-bold"
                                style="background:linear-gradient(135deg, #c63e70 0%, #dc769a 100%); color:white; border-radius:25px; font-size:1.1rem; box-shadow: 0 4px 15px rgba(198, 62, 112, 0.3);">
                            <i class="bi bi-check-circle me-2"></i>Place Order
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Hide scrollbar for order summary */
        .order-summary-scroll::-webkit-scrollbar {
            display: none;
        }
        .order-summary-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
