@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Manage Orders</h2>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
        </div>
    </div>

    @php
        $statuses = ['all', 'pending', 'processing', 'shipped', 'completed', 'cancelled'];
        $active = $activeStatus ?? 'all';
    @endphp

    <div class="btn-group mb-3" role="group" aria-label="Filter by status">
        @foreach($statuses as $status)
            @php
                $isActive = ($status === 'all' && !$activeStatus) || $activeStatus === $status;
            @endphp
            <a href="{{ $status === 'all' ? route('admin.orders') : route('admin.orders', ['status' => $status]) }}"
               class="btn btn-sm {{ $isActive ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ ucfirst($status) }}
            </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">No orders yet.</div>
    @else
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Status</th>
                <th>Placed</th>
                <th>Actions</th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

