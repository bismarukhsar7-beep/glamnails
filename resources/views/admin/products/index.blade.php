@extends('admin.layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <h2 class="mb-0">Manage Products</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>
                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                </td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category }}</td>
                <td>{{ $p->price }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('admin.products.delete', $p->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirmDelete('Are you sure you want to delete the product &quot;{{ $p->name }}&quot;?', '{{ route('admin.products.delete', $p->id) }}')">Delete</a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
