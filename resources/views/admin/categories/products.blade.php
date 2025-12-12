@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h2 class="mb-0">Products in "{{ $category->name }}"</h2>
            <p class="text-muted mb-0">{{ $category->description }}</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
            <a href="{{ route('admin.categories') }}" class="btn btn-outline-primary btn-sm">All Categories</a>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">No products found in this category.</div>
    @else
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
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
                    <td>{{ $p->price }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.products.delete', $p->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirmDelete('Are you sure you want to delete the product &quot;{{ $p->name }}&quot;?', '{{ route('admin.products.delete', $p->id) }}')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

