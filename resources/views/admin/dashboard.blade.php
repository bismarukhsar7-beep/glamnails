@extends('admin.layout')

@section('content')

    <h2>Welcome, Admin!</h2>
{{--    <p>This is your dashboard. You can now add, edit, delete products and categories.</p>--}}

    <div class="mt-4">
        <a href="{{ route('admin.products') }}" class="btn btn-primary mb-2">
            Manage Products
        </a>

{{--        <a href="#" class="btn btn-secondary mb-2">--}}
{{--            Manage Categories (coming soon)--}}
{{--        </a>--}}
    </div>

@endsection
