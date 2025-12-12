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

    <body style="background-color: #f0d3cf; display: flex; flex-direction: column; min-height: 100vh;">

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
                        <a class="nav-link dropdown-toggle fw-bold" href="{{ route('products.index') }}" id="productsDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false" style="color:#c63e70;">
                            Products
                        </a>
                        <ul class="dropdown-menu fw-bold" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="{{ route('products.index') }}">All Products</a></li>
                            @if(isset($navCategories) && $navCategories->count() > 0)
                                <li><hr class="dropdown-divider"></li>
                                @foreach($navCategories as $cat)
                                    <li><a class="dropdown-item" href="{{ route('products.index', ['category' => $cat->name]) }}">{{ $cat->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                    <!-- About -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('about') }}" style="color:#c63e70;">About Us</a>
                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/contact" style="color:#c63e70;">Contact</a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/cart" style="color:#c63e70;">Cart</a>
                    </li>

                    <!-- Search Bar with Ajax Dropdown -->
                    <div class="position-relative ms-3" style="width: 300px;">
                        <div class="d-flex">
                            <input id="productSearchInput" class="form-control" type="search" 
                                   placeholder="Search products..." autocomplete="off"
                                   style="border-color:#c63e70;">
                            <button class="btn" type="button" onclick="performSearch()" 
                                    style="background-color:#c63e70; color:white;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div id="searchDropdown" class="dropdown-menu position-absolute w-100 mt-1 search-dropdown-scroll" 
                             style="max-height: 400px; overflow-y: auto; display: none; z-index: 1050;">
                            <div id="searchResults"></div>
                        </div>
                    </div>

                    <!-- Admin Login Button -->
                    <a href="/admin/login" class="btn ms-3" style="background-color:#c63e70; color:white;">
                        Admin Login
                    </a>

                </ul>

            </div>
        </div>
    </nav>


    <!-- PAGE CONTENT -->
    <div class="container mt-4 mb-5" style="flex: 1;">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer style="background:#c9487b; padding:14px 0; margin-top:auto;">
        <div class="container text-center">

            <h5 style="color:#ffffff; font-weight:bold; margin-bottom:12px;">
                GlamNails
            </h5>

            <div class="d-flex justify-content-center gap-3" style="font-size:20px;">
                <a href="https://facebook.com" target="_blank" style="color:#ffffff;" title="Follow us on Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" target="_blank" style="color:#ffffff;" title="Follow us on Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com" target="_blank" style="color:#ffffff;" title="Follow us on Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://youtube.com" target="_blank" style="color:#ffffff;" title="Subscribe on YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
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
        
        /* Hide scrollbar for search dropdown */
        .search-dropdown-scroll::-webkit-scrollbar {
            display: none;
        }
        .search-dropdown-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Ajax Search Implementation
        let searchTimeout;
        const searchInput = document.getElementById('productSearchInput');
        const searchDropdown = document.getElementById('searchDropdown');
        const searchResults = document.getElementById('searchResults');

        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                const query = this.value.trim();

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    searchDropdown.style.display = 'none';
                    return;
                }

                searchTimeout = setTimeout(() => {
                    // Show loading state
                    searchResults.innerHTML = '<div class="dropdown-item-text text-muted p-2">Searching...</div>';
                    searchDropdown.style.display = 'block';

                    fetch(`/api/products/search?q=${encodeURIComponent(query)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success && Array.isArray(data.data)) {
                                displaySearchResults(data.data);
                            } else {
                                displaySearchResults([]);
                            }
                        })
                        .catch(error => {
                            console.error('Search failed:', error);
                            searchResults.innerHTML = '<div class="dropdown-item-text text-muted">Search unavailable</div>';
                            searchDropdown.style.display = 'block';
                        });
                }, 300);
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (searchInput && !searchInput.contains(e.target) && searchDropdown && !searchDropdown.contains(e.target)) {
                    searchDropdown.style.display = 'none';
                }
            });

            // Handle Enter key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performSearch();
                }
            });
        }

        function displaySearchResults(products) {
            if (!searchResults || !searchDropdown) return;
            
            if (products.length === 0) {
                searchResults.innerHTML = '<div class="dropdown-item-text text-muted p-2">No products found</div>';
                searchDropdown.style.display = 'block';
                return;
            }

            let html = '';
            products.forEach(product => {
                html += `
                    <a href="${product.url}" class="dropdown-item d-flex align-items-center p-2" style="text-decoration: none; border-bottom: 1px solid #f0f0f0;">
                        <img src="${product.image}" alt="${product.name}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 10px;">
                        <div class="flex-grow-1">
                            <div class="fw-bold" style="color: #c63e70;">${escapeHtml(product.name)}</div>
                            <small class="text-muted">${escapeHtml(product.category)} - PKR ${product.price}</small>
                        </div>
                    </a>
                `;
            });
            
            searchResults.innerHTML = html;
            searchDropdown.style.display = 'block';
        }

        function performSearch() {
            const query = searchInput ? searchInput.value.trim() : '';
            if (query.length >= 2) {
                window.location.href = `/products?query=${encodeURIComponent(query)}`;
            } else if (query.length === 0) {
                window.location.href = '/products';
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>

    </body>
    </html>
