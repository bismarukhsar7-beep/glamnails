<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #fff7fb;
            color: #2b2b2b;
        }
        .navbar {
            background: linear-gradient(90deg, #c63e70 0%, #e67aa5 100%);
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .btn-primary, .btn-primary:focus {
            background-color: #c63e70;
            border-color: #c63e70;
        }
        .btn-outline-primary {
            color: #c63e70;
            border-color: #c63e70;
        }
        .btn-outline-primary:hover {
            background-color: #c63e70;
            color: #fff;
        }
        .btn-outline-secondary {
            color: #6c757d;
        }
        .btn-success, .btn-success:focus {
            background-color: #5cb85c;
            border-color: #5cb85c;
        }
        .btn-danger, .btn-danger:focus {
            background-color: #e35d6a;
            border-color: #e35d6a;
        }
        .btn-link {
            color: #c63e70;
            text-decoration: none;
        }
        .btn-link:hover {
            color: #a82f5b;
            text-decoration: underline;
        }
        .btn:focus {
            box-shadow: 0 0 0 0.15rem rgba(198,62,112,0.35);
        }
        .admin-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(198, 62, 112, 0.12);
        }
        .table thead th {
            background: #ffe4ec;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4">
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

<div class="container pb-5">
    <div class="admin-card">
        @yield('content')
    </div>
</div>

<!-- Custom Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#fff0f5; border-bottom: 2px solid #dc769a;">
                <h5 class="modal-title fw-bold" id="deleteConfirmModalLabel" style="color:#c63e70;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Warning
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="deleteConfirmMessage" class="mb-0"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="deleteConfirmButton" href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(message, deleteUrl) {
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        document.getElementById('deleteConfirmMessage').textContent = message || 'Are you sure you want to delete this item?';
        document.getElementById('deleteConfirmButton').href = deleteUrl;
        modal.show();
        return false; // Prevent default link behavior
    }
</script>

</body>
</html>
