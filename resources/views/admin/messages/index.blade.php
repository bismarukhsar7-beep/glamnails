@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Contact Messages</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($messages->isEmpty())
        <div class="alert alert-info">No messages yet.</div>
    @else
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Received</th>
                <th>Actions</th>
            </tr>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->phone }}</td>
                    <td>{{ $msg->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('admin.messages.delete', $msg->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirmDelete('Are you sure you want to delete the message from &quot;{{ $msg->name }}&quot;?', '{{ route('admin.messages.delete', $msg->id) }}')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection










