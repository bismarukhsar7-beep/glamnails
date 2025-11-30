<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Left side -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            Admin Dashboard
        </a>

        <!-- Right side options -->
        <div class="d-flex align-items-center gap-2">
            <a href="/" class="btn btn-outline-light btn-sm">
                Back to Website
            </a>

            <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>

    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
