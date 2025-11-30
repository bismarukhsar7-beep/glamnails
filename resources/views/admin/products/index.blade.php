@extends('admin.layout')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h2>Manage Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category }}</td>
                <td>{{ $p->price }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('admin.products.delete', $p->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this product?')">Delete</a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
