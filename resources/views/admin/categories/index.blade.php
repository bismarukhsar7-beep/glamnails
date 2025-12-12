@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <h2 class="mb-0">Manage Categories</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Products</th>
            <th>Actions</th>
        </tr>

        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    @php
                        $productCount = \App\Models\Product::where('category', $category->name)->count();
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill {{ $productCount > 0 ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $productCount }} product(s)
                        </span>
                        @if($productCount > 0)
                            <a href="{{ route('admin.categories.products', $category->id) }}" class="btn btn-link btn-sm p-0">
                                View Products
                            </a>
                        @endif
                    </div>
                </td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirmDelete('Are you sure you want to delete the category &quot;{{ $category->name }}&quot;?', '{{ route('admin.categories.delete', $category->id) }}')">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

