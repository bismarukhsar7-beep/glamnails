@extends('layouts.app')

@section('title', $product->name . ' - GlamNails')

@section('content')
    <div class="container py-5">

        <div class="row g-5">

            {{-- LEFT: Reviews Section (40%) --}}
            <div class="col-md-4">

                <h3 class="fw-bold mb-3" style="color:#c63e70;">Customer Reviews</h3>

                {{-- Existing Reviews --}}
                <div class="mt-3">
                    @forelse ($product->reviews as $review)
                        <div class="card mb-3 shadow-sm border-0 p-3" style="background:#fff8fa;">
                            <h6 class="fw-bold">{{ $review->name }}</h6>

                            {{-- Star Rating --}}
                            <p class="mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </p>

                            <p class="text-muted small">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet. Be the first!</p>
                    @endforelse
                </div>

                {{-- Review Form --}}
                <div class="card shadow p-3 border-0 mt-4" style="background:#fff0f5;">
                    <h5 class="fw-bold">Write a Review</h5>

                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-2">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn w-100"
                                style="background:#dc769a;color:white;border-radius:25px;">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>


            {{-- RIGHT SIDE: Product Image + Info (60%) --}}
            <div class="col-md-8">

                <div class="row g-4">

                    {{-- Product Image --}}
                    <div class="col-md-6 text-center">
                        <div class="card border-0 shadow rounded-4 p-3" style="background:#fff8fa;">
                            <img src="{{ asset('images/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid rounded-4"
                                 style="max-height: 350px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="col-md-6 d-flex flex-column justify-content-center">

                        <h2 class="fw-bold mb-2" style="color:#c63e70;">
                            {{ $product->name }}
                        </h2>

                        <p class="text-muted mb-1">
                            Category: {{ $product->category }}
                        </p>

                        <h4 class="fw-bold my-2" style="color:#c63e70;">
                            PKR {{ number_format($product->price, 2) }}
                        </h4>

                        <p class="text-secondary mb-3">
                            {{ $product->description }}
                        </p>

                        {{-- Add to Cart --}}
                        <form action="{{ route('cart.add') }}" method="POST"
                              class="d-flex align-items-center"
                              style="margin-top: 5px;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <label class="me-2 fw-semibold">Qty:</label>

                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   class="form-control text-center me-3"
                                   style="width: 80px;">

                            <button type="submit"
                                    class="btn px-4"
                                    style="background:#dc769a; color:white; border-radius:25px;">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </form>

                    </div>


                </div>

            </div>

        </div>
    </div>
@endsection
