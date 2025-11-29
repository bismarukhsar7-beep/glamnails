@extends('layouts.app')

@section('title', 'Search Results - GlamNails')

@section('content')
    <div class="container py-5">

        <h3 class="fw-bold mb-4" style="color:#c63e70;">
            Search Results for "{{ $query }}"
        </h3>

        <div class="row g-4">

            @forelse($results as $product)
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
                <p class="text-muted">No matching products found.</p>
            @endforelse

        </div>
    </div>
@endsection
