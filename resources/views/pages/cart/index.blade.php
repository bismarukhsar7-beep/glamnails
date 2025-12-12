@extends('layouts.app')

@section('title','Your Cart - GlamNails')

@section('content')
    <div class="container py-5">

        <h2 class="mb-4 text-center" style="color:#c63e70;">🛒 Your Cart</h2>

        {{-- If cart is empty --}}
        @if (empty($cartItems))
            <div class="alert alert-info text-center">
                Your cart is empty.
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('products.index') }}" class="btn" style="background:#dc769a;color:white;border-radius:25px;">
                    Continue Shopping
                </a>
            </div>
        @else

            {{-- Cart Items --}}
            <div class="row">
                @foreach ($cartItems as $item)
                    @php
                        $product = $item['product'];
                    @endphp

                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm p-3 d-flex flex-row align-items-center" style="background:#fff8fa;">

                            {{-- Product Image --}}
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:10px;">


                            {{-- Product Info --}}
                            <div class="ms-4 flex-grow-1">
                                <h5>{{ $product->name }}</h5>
                                <p class="text-muted mb-1">PKR {{ number_format($product->price) }}</p>

                                {{-- Update Quantity --}}
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item['quantity'] }}"
                                           min="1"
                                           class="form-control"
                                           style="width:80px;">
                                    <button type="submit"
                                            class="btn btn-sm ms-2"
                                            style="background:#dc769a;color:white;">
                                        Update
                                    </button>
                                </form>
                            </div>

                            {{-- Remove Button --}}
                            <form action="{{ route('cart.remove') }}" method="POST" class="ms-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        style="border-radius:25px;">
                                    Remove
                                </button>
                            </form>

                            {{-- Subtotal --}}
                            <div class="ms-4">
                                <strong>PKR {{ number_format($item['subtotal']) }}</strong>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Cart Summary --}}
            <div class="text-end mt-4">
                <h4>Total: <strong>PKR {{ number_format($total) }}</strong></h4>

                <a href="{{ route('checkout.index') }}"
                   class="btn mt-3"
                   style="background:#c63e70;color:white;border-radius:25px;">
                    Proceed to Checkout
                </a>

                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline-block ms-3">
                    @csrf
                    <button type="submit"
                            class="btn btn-outline-danger"
                            style="border-radius:25px;">
                        Clear Cart
                    </button>
                </form>
            </div>

        @endif

    </div>
@endsection
