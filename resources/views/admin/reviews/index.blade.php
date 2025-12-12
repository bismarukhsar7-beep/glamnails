@extends('admin.layout')

@section('title', 'Admin - Reviews Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reviews Management</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $review->product->id) }}" target="_blank">
                                                {{ $review->product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $review->name }}</td>
                                        <td>
                                            <span class="badge bg-warning">
                                                {{ $review->rating }}/5 ⭐
                                            </span>
                                        </td>
                                        <td>
                                            {{ Str::limit($review->comment, 50) }}
                                            @if(strlen($review->comment) > 50)
                                                <a href="{{ route('admin.reviews.show', $review->id) }}" class="text-primary">...read more</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($review->image)
                                                <img src="{{ $review->image_url }}" alt="Review" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.reviews.delete', $review->id) }}"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this review?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            No reviews found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($reviews->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


