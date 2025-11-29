@extends('layouts.app')

@section('title', 'Products - GlamNails')

@section('content')
    <div class="container py-5">

        <h2 class="fw-bold mb-4" style="color:#c63e70;">Our Products</h2>

        {{-- Category Filters --}}
        <div class="mb-4 d-flex gap-2 flex-wrap">

            {{-- All --}}
            <a href="{{ route('products.index') }}"
               class="btn {{ request('category') ? 'btn-outline-secondary' : 'text-white' }}"
               style="background: {{ request('category') ? 'transparent' : '#dc769a' }}; border-radius:25px;">
                All
            </a>

            {{-- Nail Polishes --}}
            <a href="{{ route('products.index', ['category' => 'Nail Polishes']) }}"
               class="btn {{ request('category') === 'Nail Polishes' ? 'text-white' : 'btn-outline-secondary' }}"
               style="background: {{ request('category') === 'Nail Polishes' ? '#dc769a' : 'transparent' }}; border-radius:25px;">
                Nail Polishes
            </a>

            {{-- Accessories --}}
            <a href="{{ route('products.index', ['category' => 'Accessories']) }}"
               class="btn {{ request('category') === 'Accessories' ? 'text-white' : 'btn-outline-secondary' }}"
               style="background: {{ request('category') === 'Accessories' ? '#dc769a' : 'transparent' }}; border-radius:25px;">
                Accessories
            </a>

            {{-- Nail Care --}}
            <a href="{{ route('products.index', ['category' => 'Nail Care']) }}"
               class="btn {{ request('category') === 'Nail Care' ? 'text-white' : 'btn-outline-secondary' }}"
               style="background: {{ request('category') === 'Nail Care' ? '#dc769a' : 'transparent' }}; border-radius:25px;">
                Nail Care
            </a>

            {{-- Tools --}}
            <a href="{{ route('products.index', ['category' => 'Tools']) }}"
               class="btn {{ request('category') === 'Tools' ? 'text-white' : 'btn-outline-secondary' }}"
               style="background: {{ request('category') === 'Tools' ? '#dc769a' : 'transparent' }}; border-radius:25px;">
                Tools
            </a>

        </div>

        {{-- Product Grid --}}
        <div class="row g-4">

            @forelse($products as $product)
                <div class="col-md-3">
                    <div class="card border-0 shadow rounded-4 p-3" style="background:#fff8fa;">
                        <img src="{{ asset('images/' . $product->image) }}"
                             class="card-img-top rounded-4"
                             style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center">
                            <h5 class="fw-bold" style="color:#c63e70;">{{ $product->name }}</h5>
                            <p class="text-muted mb-1">{{ $product->category }}</p>
                            <p class="fw-bold">PKR {{ $product->price }}</p>

                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn w-100 mt-2"
                               style="background:#dc769a; color:white; border-radius:25px;">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No products found.</p>
            @endforelse

        </div>
    </div>
@endsection
