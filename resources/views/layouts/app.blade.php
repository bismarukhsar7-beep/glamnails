<!DOCTYPE html>
    <html>
    <head>
        <title>Beauty Store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <style>
            .nav-link.active {
                color: #c63e70 !important;
                font-weight: bold;
            }

            .dropdown-item.active {
                background-color: #f0d3cf !important;
                color: #fff !important;
            }
        </style>
    </head>

    <body style="background-color: #f0d3cf;">

    <!-- NAVBAR -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: rgba(248,149,179,0.84)">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="/" style="color:#c63e70;">
                GlamNails
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- Home -->
                    <li class="nav-item ">
                        <a class="nav-link fw-bold" href="/" style="color:#c63e70;">Home</a>
                    </li>

                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="productsDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false" style="color:#c63e70;">
                            Products
                        </a>
                        <ul class="dropdown-menu fw-bold">

                            <li><a class="dropdown-item" href="{{ route('category.products', 'nail polishes') }}">Nail Polishes</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.products', 'accessories') }}">Accessories</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.products', 'nail care') }}">Nail Care</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.products', 'tools') }}">Tools</a></li>

                        </ul>

                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/contact" style="color:#c63e70;">Contact</a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/cart" style="color:#c63e70;">Cart</a>
                    </li>

                    <!-- Search Bar -->
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex ms-3">
                        <input class="form-control" type="search" placeholder="Search products..." name="query"
                               style="border-color:#c63e70;">
                        <button class="btn ms-2" type="submit" style="background-color:#c63e70; color:white;">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <!-- Admin Login Button -->
                    <a href="/admin/login" class="btn ms-3" style="background-color:#c63e70; color:white;">
                        Admin Login
                    </a>

                </ul>

            </div>
        </div>
    </nav>


    <!-- PAGE CONTENT -->
    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer style="background:#c9487b; padding:20px; margin-top:10px;">
        <div class="container text-center">

            <h5 style="color:#ffffff; font-weight:bold; margin-bottom:15px;">
                GlamNails
            </h5>

            <div class="d-flex justify-content-center gap-3" style="font-size:20px;">
                <a href="#" style="color:#ffffff;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color:#ffffff;"><i class="fab fa-instagram"></i></a>
                <a href="#" style="color:#ffffff;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color:#ffffff;"><i class="fab fa-youtube"></i></a>
            </div>

        </div>
    </footer>


    <!-- ICONS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

    <style>
        footer .social-icons a {
            color: #ffffff;
            font-size: 22px;
            margin: 0 12px;
            transition: 0.3s;
        }

        footer .social-icons a:hover {
            color: #c63e70 !important;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>
</>
