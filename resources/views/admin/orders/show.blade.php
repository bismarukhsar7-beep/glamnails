@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Order #{{ $order->id }}</h2>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
            <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary btn-sm">All Orders</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <strong>Customer:</strong> {{ $order->name }}<br>
        <strong>Email:</strong> {{ $order->email }}<br>
        <strong>Phone:</strong> {{ $order->phone }}<br>
        <strong>Address:</strong> {{ $order->address }}<br>
        <strong>Total:</strong> ${{ number_format($order->total, 2) }}<br>
        <strong>Status:</strong> {{ $order->status }}<br>
        <strong>Placed:</strong> {{ $order->created_at }}
    </div>

    <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="mb-4">
        @csrf
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label class="col-form-label">Update status</label>
            </div>
            <div class="col-auto">
                <select name="status" class="form-select">
                    @foreach(['pending','processing','shipped','completed','cancelled'] as $status)
                        <option value="{{ $status }}" @if($order->status === $status) selected @endif>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    <h4>Items</h4>
    @if($order->items->isEmpty())
        <div class="alert alert-info">No items found for this order.</div>
    @else
        <table class="table table-bordered">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <a href="{{ route('admin.orders') }}" class="btn btn-link p-0 mt-3">Back to orders</a>
@endsection

