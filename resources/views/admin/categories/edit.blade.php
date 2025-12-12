@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Edit Category</h2>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
            <a href="{{ route('admin.categories') }}" class="btn btn-outline-primary btn-sm">All Categories</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            @if($category->image)
                <div class="mb-2">
                    <p class="text-muted small">Current Image:</p>
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px solid #dc769a;">
                </div>
            @endif
            <input type="file" name="image" id="categoryImageInputEdit" class="form-control" accept="image/*" onchange="previewImage(this, 'categoryImagePreviewEdit')">
            <small class="text-muted">Upload a new image to replace the current one</small>
            <div id="categoryImagePreviewEdit" class="mt-2" style="display: none;">
                <p class="text-muted small">New Image Preview:</p>
                <img id="categoryImagePreviewImgEdit" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 2px solid #dc769a;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Cancel</a>
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

