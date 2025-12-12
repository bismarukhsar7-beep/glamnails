@extends('layouts.app')

@section('title', 'Products - GlamNails')

@section('content')
    <div class="container py-5">

        <h2 class="fw-bold mb-4" style="color:#c63e70;">Our Products</h2>

        {{-- Category Filters --}}
        <div class="mb-4 d-flex gap-2 flex-wrap">
            <a href="{{ route('products.index') }}"
               class="btn {{ request('category') ? 'btn-outline-secondary' : 'text-white' }}"
               style="background: {{ request('category') ? 'transparent' : '#dc769a' }}; border-radius:25px;">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->name]) }}"
                   class="btn {{ request('category') === $cat->name ? 'text-white' : 'btn-outline-secondary' }}"
                   style="background: {{ request('category') === $cat->name ? '#dc769a' : 'transparent' }}; border-radius:25px;">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Product Grid --}}
        <div class="row g-4">

            @forelse($products as $product)
                <div class="col-md-3 d-flex">
                    <div class="card border-0 shadow rounded-4 p-2 d-flex flex-column" style="background:#fff8fa; width: 100%;">
                        <img src="{{ $product->image_url }}"
                             class="card-img-top rounded-4"
                             style="height: 200px; object-fit: cover; width: 100%;">

                        <div class="card-body text-center d-flex flex-column flex-grow-1" style="padding: 0.75rem;">
                            <h5 class="fw-bold mb-1" style="color:#c63e70; min-height: 2.5rem; display: flex; align-items: center; justify-content: center;">{{ $product->name }}</h5>
                            <p class="text-muted mb-1">{{ $product->category }}</p>
                            <p class="fw-bold mb-2">PKR {{ $product->price }}</p>

                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn w-100 mt-auto"
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
