@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Message #{{ $message->id }}</h2>
        <div class="btn-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
            <a href="{{ route('admin.messages') }}" class="btn btn-outline-primary btn-sm">All Messages</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $message->name }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Phone:</strong> {{ $message->phone }}</p>
            <p><strong>Received:</strong> {{ $message->created_at }}</p>
            <p><strong>Message:</strong><br>{{ $message->message }}</p>
        </div>
    </div>

    <a href="{{ route('admin.messages.delete', $message->id) }}"
       class="btn btn-danger"
       onclick="return confirmDelete('Are you sure you want to delete the message from &quot;{{ $message->name }}&quot;?', '{{ route('admin.messages.delete', $message->id) }}')">Delete</a>
    <a href="{{ route('admin.messages') }}" class="btn btn-link">Back to messages</a>
@endsection










