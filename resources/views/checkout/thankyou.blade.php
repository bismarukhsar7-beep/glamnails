@extends('layouts.app')

@section('title','Thank You - GlamNails')

@section('content')
    <div class="container text-center py-5">
        <div class="card mx-auto p-4 shadow-sm" style="max-width:600px; background:#fff8fa;">
            <h2 style="color:#c63e70;">🎉 Thank you for your order!</h2>
            <p class="mt-3 text-muted">We received your order and will process it soon. A confirmation will be sent to your email.</p>
            <a href="{{ route('products.index') }}" class="btn mt-3" style="background:#dc769a;color:white;border-radius:25px;">Continue Shopping</a>
        </div>
    </div>
@endsection
