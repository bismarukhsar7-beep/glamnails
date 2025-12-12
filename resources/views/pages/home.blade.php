@extends('layouts.app')

@section('title', 'GlamNails - Home')

@section('content')

    <!-- Hero Section -->
    <div class="row align-items-center" style="background-color: #f0d3cf;">
        <div class="col-md-6">
            <h1 class="display-3 fw-bold text-uppercase" style="color: #c63e70;">
                Welcome to <span style="color: #111;">GlamNails</span>
            </h1>
            <p class="lead text-muted mt-3">
                Discover the latest in nail art and accessories for every occasion.
            </p>
            <hr class="w-25 mx-auto mt-4" style="border-top: 3px solid #e91e63;">

            <a href="/products" class="btn mt-3"
               style="background-color: #dc769a; color: white; font-weight: 600;
                      border-radius: 30px; padding: 10px 25px;">
                Shop Now
            </a>
        </div>

        <div class="col-md-6 text-center">
            <img src="{{ asset('images/nails1.png') }}" alt="nails" class="img-fluid mt-4" style="max-height: 400px;">
        </div>
    </div>



    <!-- Categories Section -->
    <section class="py-5">
        <div class="container text-center">

            <h2 class="fw-bold mb-5" style="color: #c63e70;">✨ Explore Our Categories ✨</h2>

            <div class="row g-4 justify-content-center">
                @forelse($categories as $cat)
                    @php
                        // Fallback image mapping for existing categories
                        $imageMap = [
                            'Nail Polishes' => 'nailpolish (2).jpg',
                            'nail polishes' => 'nailpolish (2).jpg',
                            'Accessories' => 'accessories.jpg',
                            'accessories' => 'accessories.jpg',
                            'Nail Care' => 'nailcare.jpg',
                            'nail care' => 'nailcare.jpg',
                            'Tools' => 'tools.jpg',
                            'tools' => 'tools.jpg',
                        ];
                        $imagePath = $cat->image 
                            ? asset($cat->image) 
                            : (isset($imageMap[$cat->name]) ? asset('images/' . $imageMap[$cat->name]) : asset('images/nailpolish (2).jpg'));
                    @endphp
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <img src="{{ $imagePath }}" class="card-img-top"
                                 alt="{{ $cat->name }}"
                                 style="height: 300px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #c63e70;">{{ $cat->name }}</h5>
                                <a href="{{ route('products.index', ['category' => $cat->name]) }}" class="btn"
                                   style="background-color: #dc769a; color: #fff; border-radius: 25px;">
                                    View Products
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No categories yet.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
