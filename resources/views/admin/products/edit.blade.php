@extends('admin.layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Edit Product</h2>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
            <a href="{{ route('admin.products') }}" class="btn btn-outline-primary btn-sm">All Products</a>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">

        <label>Category</label>
        <select name="category" class="form-control mb-2" required>
            <option value="">Select a category</option>
            @foreach($categories ?? [] as $cat)
                <option value="{{ $cat->name }}" {{ $product->category == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>

        <label>Price</label>
        <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-2">

        <label>Description</label>
        <textarea name="desc" class="form-control mb-2">{{ $product->desc }}</textarea>

        <label>Image</label>
        @if($product->image)
            <div class="mb-2">
                <p class="text-muted small">Current Image:</p>
                <img src="{{ $product->image_url }}" alt="Current" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px solid #dc769a;">
            </div>
        @endif
        <input type="file" name="image" id="productImageInputEdit" class="form-control mb-2" accept="image/*" onchange="previewImage(this, 'productImagePreviewEdit')">
        <div id="productImagePreviewEdit" class="mt-2" style="display: none;">
            <p class="text-muted small">New Image Preview:</p>
            <img id="productImagePreviewImgEdit" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 2px solid #dc769a;">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const previewImg = document.getElementById(previewId + 'Img');
            
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
    </script>

@endsection
