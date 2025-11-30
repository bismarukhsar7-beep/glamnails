@extends('admin.layout')

@section('content')

    <h2>Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">

        <label>Category</label>
        <input type="text" name="category" value="{{ $product->category }}" class="form-control mb-2">

        <label>Price</label>
        <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-2">

        <button class="btn btn-primary">Update</button>
    </form>

@endsection
