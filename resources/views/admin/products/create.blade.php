@extends('admin.layout')

@section('content')

    <h2>Add Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name</label>
        <input type="text" name="name" class="form-control mb-2">

        <label>Category</label>
        <input type="text" name="category" class="form-control mb-2">

        <label>Price</label>
        <input type="number" name="price" class="form-control mb-2">

        <label>Description</label>
        <textarea name="desc" class="form-control mb-2"></textarea>

        <label>Image</label>
        <input type="file" name="image" class="form-control mb-2">

        <button class="btn btn-success">Save</button>
    </form>

@endsection
