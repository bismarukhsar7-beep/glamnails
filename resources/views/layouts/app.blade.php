<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GlamNails')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff5f7;
        }
        nav.navbar {
            background-color: #dc769a;
        }
        nav a.nav-link, .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        nav a.nav-link:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #dc769a;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">GlamNails</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                {{-- UPDATED PRODUCTS DROPDOWN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => 'Nail Polishes']) }}">
                                Nail Polishes
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => 'Accessories']) }}">
                                Accessories
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => 'Nail Care']) }}">
                                Nail Care
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => 'Tools']) }}">
                                Tools
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- Cart --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        🛒 Cart
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge bg-danger">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </li>

                {{-- Contact --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>

                {{-- Search --}}
                <form action="{{ route('products.index') }}" method="GET" class="d-flex ms-3" role="search">
                    <input class="form-control me-2" type="search" name="query"
                           placeholder="Search products..." aria-label="Search" required>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

            </ul>

        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<footer class="text-center" style="background-color:#dc769a; color:white; font-family:'Poppins', sans-serif; padding:10px 0;">

    <p class="fw-semibold mb-1" style="font-size:14px;">
        © {{ date('Y') }} GlamNails. All Rights Reserved.
    </p>

    <div style="font-size:18px;">
        <a href="#" class="text-decoration-none mx-2" style="color:white;">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="#" class="text-decoration-none mx-2" style="color:white;">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="#" class="text-decoration-none mx-2" style="color:white;">
            <i class="bi bi-tiktok"></i>
        </a>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
