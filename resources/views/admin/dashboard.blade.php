@extends('admin.layout')

@section('content')

    <h2>Welcome, Admin!</h2>
{{--    <p>This is your dashboard. You can now add, edit, delete products and categories.</p>--}}

    <div class="mt-4 d-flex flex-wrap gap-2">
        <a href="{{ route('admin.products') }}" class="btn btn-primary shadow-sm">
            Manage Products
        </a>
        <a href="{{ route('admin.categories') }}" class="btn btn-primary shadow-sm">
            Manage Categories
        </a>
        <a href="{{ route('admin.orders') }}" class="btn btn-primary shadow-sm">
            Manage Orders
        </a>
        <a href="{{ route('admin.reviews') }}" class="btn btn-primary shadow-sm">
            Manage Reviews
        </a>
        <a href="{{ route('admin.messages') }}" class="btn btn-primary shadow-sm">
            Contact Messages
        </a>
    </div>

@endsection
