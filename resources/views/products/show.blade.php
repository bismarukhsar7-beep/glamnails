@extends('layouts.app')

@section('title', $product->name . ' - GlamNails')

@section('content')
    <div class="container py-5">

        <div class="row g-4">

            {{-- LEFT: Product Image + Info (60%) --}}
            <div class="col-md-7">
                <div class="card border-0 shadow-lg rounded-4 p-4" style="background:#fff8fa;">
                    <div class="row g-4">
                        {{-- Product Image --}}
                        <div class="col-md-6 text-center">
                            <div class="position-relative">
                                <img src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded-4 shadow-sm"
                                     style="max-height: 450px; width: 100%; object-fit: cover;">
                            </div>
                        </div>

                        {{-- Product Info --}}
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <span class="badge rounded-pill px-3 py-2" style="background:#dc769a; color:white;">
                                    {{ $product->category }}
                                </span>
                            </div>

                            <h1 class="fw-bold mb-3" style="color:#c63e70; font-size: 1.75rem;">
                                {{ $product->name }}
                            </h1>

                            <div class="mb-3">
                                <h2 class="fw-bold mb-0" style="color:#c63e70; font-size: 2rem;">
                                    PKR {{ number_format($product->price, 2) }}
                                </h2>
                            </div>

                            <div class="mb-4">
                                <p class="text-secondary" style="line-height: 1.8; font-size: 0.95rem;">
                                    {{ $product->desc ?? 'Premium quality product from GlamNails collection.' }}
                                </p>
                            </div>

                            {{-- Add to Cart --}}
                            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <label class="fw-semibold mb-0" style="color:#c63e70;">Quantity:</label>
                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="form-control text-center rounded-pill"
                                           style="width: 100px; border-color:#dc769a;">
                                </div>

                                <button type="submit"
                                        class="btn w-100 py-2 fw-bold"
                                        style="background:linear-gradient(135deg, #c63e70 0%, #dc769a 100%); color:white; border-radius:25px; font-size:1rem; box-shadow: 0 4px 15px rgba(198, 62, 112, 0.3);">
                                    <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                </button>
                            </form>

                            <div class="border-top pt-3">
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-shield-check text-success me-1"></i>
                                    Secure Payment | Free Shipping | Easy Returns
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Reviews Section (40%) --}}
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4 p-4" style="background:#fff8fa;">
                    <h4 class="fw-bold mb-4" style="color:#c63e70; font-size: 1.5rem;">
                        <i class="bi bi-star-fill me-2"></i>Customer Reviews
                    </h4>

                    {{-- Existing Reviews --}}
                    <div class="mb-4" style="max-height: 400px; overflow-y: auto;">
                        @forelse ($product->reviews as $review)
                            <div class="card mb-3 border-0 p-3 rounded-3" style="background:white; border-left: 3px solid #dc769a !important;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0" style="color:#c63e70;">{{ $review->name }}</h6>
                                    <span class="badge rounded-pill" style="background:#fff0f5; color:#c63e70;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ⭐
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <p class="text-muted mb-2 small">{{ $review->comment }}</p>
                                @if($review->image)
                                    <div class="mt-2">
                                        <img src="{{ $review->image_url }}"
                                             alt="Product Review Image"
                                             class="img-fluid rounded-3"
                                             style="max-width: 100%; max-height: 150px; cursor: pointer; border: 1px solid #f0d3cf;"
                                             onclick="openImageModal('{{ $review->image_url }}', '{{ $review->name }} Review')">
                                        <small class="text-muted">
                                            <i class="bi bi-camera me-1"></i>Review photo
                                        </small>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-chat-dots" style="font-size: 3rem; color: #dc769a;"></i>
                                <p class="text-muted mt-3">No reviews yet. Be the first to review!</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Review Form --}}
                    <div class="card border-0 p-4 rounded-3 mt-4" style="background:#fff0f5; border: 2px dashed #dc769a !important;">
                        <h5 class="fw-bold mb-3" style="color:#c63e70; font-size: 1.25rem;">
                            <i class="bi bi-pencil-square me-2"></i>Write a Review
                        </h5>

                        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color:#c63e70;">Your Name</label>
                                <input type="text" name="name" class="form-control rounded-pill" placeholder="Enter your name" required
                                       style="border-color:#dc769a;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color:#c63e70;">Rating</label>
                                <select name="rating" class="form-control rounded-pill" required style="border-color:#dc769a;">
                                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                    <option value="4">⭐⭐⭐⭐ Very Good</option>
                                    <option value="3">⭐⭐⭐ Good</option>
                                    <option value="2">⭐⭐ Fair</option>
                                    <option value="1">⭐ Poor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color:#c63e70;">Your Review</label>
                                <textarea name="comment" class="form-control rounded-3" rows="3"
                                          placeholder="Share your experience..." required
                                          style="border-color:#dc769a;"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color:#c63e70;">
                                    <i class="bi bi-camera me-1"></i>Upload Photos (Optional)
                                </label>
                                <input type="file" name="image" id="reviewImageInput" class="form-control rounded-pill"
                                       accept="image/*" onchange="previewReviewImage(this)"
                                       style="border-color:#dc769a;">
                                <small class="text-muted">Share photos related to your experience</small>
                                <div id="reviewImagePreview" class="mt-2" style="display: none;">
                                    <p class="text-muted small mb-2">📸 Image Preview:</p>
                                    <img id="reviewImagePreviewImg" src="" alt="Review Image Preview"
                                         style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 2px solid #dc769a;">
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 fw-bold rounded-pill"
                                    style="background:#dc769a;color:white; padding: 10px;">
                                <i class="bi bi-send me-2"></i>Submit Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Image Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Review Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Review Image" class="img-fluid rounded-3">
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewReviewImage(input) {
            const preview = document.getElementById('reviewImagePreview');
            const previewImg = document.getElementById('reviewImagePreviewImg');

            if (input.files && input.files[0]) {
                // Validate file type
                const fileType = input.files[0].type;
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];

                if (!validTypes.includes(fileType)) {
                    alert('Please select a valid image file (JPEG, PNG, GIF, or WebP)');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Validate file size (max 5MB)
                const fileSize = input.files[0].size / 1024 / 1024; // Size in MB
                if (fileSize > 5) {
                    alert('Image size should be less than 5MB');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalLabel').textContent = title;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }
    </script>
@endsection
