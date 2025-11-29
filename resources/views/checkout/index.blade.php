@extends('layouts.app')

@section('title', 'Checkout - GlamNails')

@section('content')
    <div class="container py-5">

        <h2 class="text-center mb-4" style="color:#c63e70;">Checkout</h2>

        @if (!$cartItems || count($cartItems) === 0)
            <div class="alert alert-info text-center">
                Your cart is empty.
            </div>
            <div class="text-center">
                <a href="{{ route('products.index') }}" class="btn" style="background:#dc769a;color:white;border-radius:25px;">
                    Continue Shopping
                </a>
            </div>
            @return
        @endif

        <div class="row">

            {{-- LEFT: Order Summary --}}
            <div class="col-md-6">
                <h4 class="mb-3">Order Summary</h4>

                @foreach ($cartItems as $item)
                    @php $product = $item['product']; @endphp

                    <div class="d-flex align-items-center p-2 mb-3 shadow-sm" style="background:#fff8fa;border-radius:10px;">

                        {{-- FIXED IMAGE PATH --}}
                        <img src="{{ asset('images/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             style="width:80px;height:80px;object-fit:cover;border-radius:10px;">


                        <div class="ms-3">
                            <h6 class="mb-1">{{ $product->name }}</h6>

                            <p class="mb-1">Qty: {{ $item['quantity'] }}</p>

                            {{-- FIXED PRICE TO PKR --}}
                            <p class="mb-0">Price: PKR {{ number_format($item['subtotal']) }}</p>
                        </div>
                    </div>

                @endforeach

                {{-- FIXED TOTAL TO PKR --}}
                <h4 class="text-end mt-3">
                    Total: <strong>PKR {{ number_format($total) }}</strong>
                </h4>
            </div>

            {{-- RIGHT: Checkout Form --}}
            <div class="col-md-6">
                <h4 class="mb-3">Billing Details</h4>

                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit"
                            class="btn w-100 mt-3"
                            style="background:#c63e70;color:white;border-radius:25px;">
                        Place Order
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
