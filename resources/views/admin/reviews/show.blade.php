@extends('admin.layout')

@section('title', 'Admin - Review Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Review Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.reviews') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Reviews
                        </a>
                        <a href="{{ route('admin.reviews.delete', $review->id) }}"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this review?')">
                            <i class="fas fa-trash"></i> Delete Review
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Review Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Review ID:</strong> {{ $review->id }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Customer Name:</strong> {{ $review->name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Rating:</strong>
                                        <span class="badge bg-warning fs-6">
                                            {{ $review->rating }}/5 ⭐
                                        </span>
                                        <div class="mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Comment:</strong>
                                        <div class="mt-2 p-3 bg-light rounded">
                                            {{ $review->comment }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Review Image:</strong>
                                        <div class="mt-2">
                                            @if($review->image)
                                                <img src="{{ $review->image_url }}" alt="Review Image"
                                                     class="img-fluid rounded" style="max-width: 300px; max-height: 300px; border: 2px solid #dc769a;">
                                                <p class="text-muted small mt-2">
                                                    <i class="bi bi-camera me-1"></i>Customer uploaded image with review
                                                </p>
                                            @else
                                                <p class="text-muted">No image uploaded with this review</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Submitted:</strong> {{ $review->created_at->format('F d, Y \a\t h:i A') }}
                                    </div>
                                    @if($review->updated_at != $review->created_at)
                                        <div class="mb-3">
                                            <strong>Last Updated:</strong> {{ $review->updated_at->format('F d, Y \a\t h:i A') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Product Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        @if($review->product->image)
                                            <img src="{{ $review->product->image_url }}"
                                                 alt="{{ $review->product->name }}"
                                                 class="img-fluid rounded"
                                                 style="max-height: 150px;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                 style="height: 150px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <strong>Name:</strong>
                                        <a href="{{ route('products.show', $review->product->id) }}" target="_blank">
                                            {{ $review->product->name }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Category:</strong> {{ $review->product->category }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Price:</strong> PKR {{ number_format($review->product->price, 2) }}
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('products.show', $review->product->id) }}"
                                           class="btn btn-primary btn-sm" target="_blank">
                                            <i class="fas fa-eye"></i> View Product
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


