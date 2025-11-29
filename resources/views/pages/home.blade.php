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


                <!-- Nail Polishes -->
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ asset('images/nailpolish (2).jpg') }}" class="card-img-top"
                             alt="Nail Polishes"
                             style="height: 300px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #c63e70;">Nail Polishes</h5>

                            <a href="{{ url('/products?category=Nail Polishes') }}" class="btn"
                               style="background-color: #dc769a; color: #fff; border-radius: 25px;">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Accessories -->
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ asset('images/accessories.jpg') }}" class="card-img-top"
                             alt="Accessories"
                             style="height: 300px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #c63e70;">Accessories</h5>

                            <a href="{{ url('/products?category=Accessories') }}" class="btn"
                               style="background-color: #dc769a; color: #fff; border-radius: 25px;">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Nail Care -->
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ asset('images/nailcare.jpg') }}" class="card-img-top"
                             alt="Nail Care"
                             style="height: 300px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #c63e70;">Nail Care</h5>

                            <a href="{{ url('/products?category=Nail Care') }}" class="btn"
                               style="background-color: #dc769a; color: #fff; border-radius: 25px;">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Tools -->
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ asset('images/tools.jpg') }}" class="card-img-top"
                             alt="Tools"
                             style="height: 300px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #c63e70;">Tools</h5>

                            <a href="{{ url('/products?category=Tools') }}" class="btn"
                               style="background-color: #dc769a; color: #fff; border-radius: 25px;">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection
