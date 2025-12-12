@extends('layouts.app')

@section('title', 'AJAX Debug - GlamNails')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4" style="color:#c63e70;">🔧 AJAX Search Debug</h1>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5>✅ Test API Endpoint (WORKING)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Search Query:</label>
                        <input type="text" id="debugQuery" class="form-control" value="nail" placeholder="Enter search term">
                    </div>
                    <button onclick="testAPI()" class="btn btn-primary">Test API</button>
                    <button onclick="testAJAX()" class="btn btn-success ms-2">Test AJAX</button>
                    <button onclick="testDirect()" class="btn btn-warning ms-2">Test Direct</button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5>API Response</h5>
                </div>
                <div class="card-body">
                    <pre id="apiResponse" class="bg-light p-3 rounded" style="font-size: 0.8rem; max-height: 300px; overflow-y: auto;"></pre>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Search Bar Test</h5>
                </div>
                <div class="card-body">
                    <div class="position-relative" style="width: 100%;">
                        <div class="d-flex">
                            <input id="debugSearchInput" class="form-control" type="search"
                                   placeholder="Search products..." autocomplete="off"
                                   style="border-color:#c63e70;">
                            <button class="btn" type="button" onclick="performDebugSearch()"
                                    style="background-color:#c63e70; color:white;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div id="debugSearchDropdown" class="dropdown-menu position-absolute w-100 mt-1"
                             style="max-height: 400px; overflow-y: auto; display: none; z-index: 1050;">
                            <div id="debugSearchResults"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5>Console Log</h5>
                </div>
                <div class="card-body">
                    <div id="consoleLog" class="bg-dark text-light p-3 rounded" style="font-family: monospace; font-size: 0.8rem; max-height: 300px; overflow-y: auto;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function log(message) {
        const consoleLog = document.getElementById('consoleLog');
        const timestamp = new Date().toLocaleTimeString();
        consoleLog.innerHTML += `[${timestamp}] ${message}\n`;
        consoleLog.scrollTop = consoleLog.scrollHeight;
        console.log(message);
    }

    function testAPI() {
        const query = document.getElementById('debugQuery').value;
        log(`Testing API with query: "${query}"`);

        fetch(`/debug/search?q=${encodeURIComponent(query)}`)
            .then(response => {
                log(`API Response status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                log('API Response data:');
                document.getElementById('apiResponse').textContent = JSON.stringify(data, null, 2);
                log(JSON.stringify(data, null, 2));
            })
            .catch(error => {
                log(`API Error: ${error.message}`);
                document.getElementById('apiResponse').textContent = `Error: ${error.message}`;
            });
    }

    function testAJAX() {
        const query = document.getElementById('debugQuery').value;
        log(`Testing AJAX with query: "${query}"`);

        fetch(`/api/products/search?q=${encodeURIComponent(query)}`)
            .then(response => {
                log(`AJAX Response status: ${response.status}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                log('AJAX Response data:');
                log(JSON.stringify(data, null, 2));
                document.getElementById('apiResponse').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                log(`AJAX Error: ${error.message}`);
                document.getElementById('apiResponse').textContent = `Error: ${error.message}`;
            });
    }

    function testDirect() {
        const query = document.getElementById('debugQuery').value;
        log(`Testing direct route with query: "${query}"`);

        fetch(`/test-api-search?q=${encodeURIComponent(query)}`)
            .then(response => {
                log(`Direct Response status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                log('Direct Response data:');
                log(JSON.stringify(data, null, 2));
                document.getElementById('apiResponse').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                log(`Direct Error: ${error.message}`);
                document.getElementById('apiResponse').textContent = `Error: ${error.message}`;
            });
    }

    function performDebugSearch() {
        const input = document.getElementById('debugSearchInput');
        const query = input.value.trim();
        const dropdown = document.getElementById('debugSearchDropdown');
        const results = document.getElementById('debugSearchResults');

        log(`Performing search with query: "${query}"`);

        if (query.length < 2) {
            dropdown.style.display = 'none';
            return;
        }

        fetch(`/api/products/search?q=${encodeURIComponent(query)}`)
            .then(response => {
                log(`Search Response status: ${response.status}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                log('Search Response data:');
                log(JSON.stringify(data, null, 2));

                if (data.success && data.data) {
                    displayDebugResults(data.data);
                } else {
                    results.innerHTML = '<div class="dropdown-item-text text-muted p-2">No products found</div>';
                    dropdown.style.display = 'block';
                }
            })
            .catch(error => {
                log(`Search Error: ${error.message}`);
                results.innerHTML = `<div class="dropdown-item-text text-muted">Search unavailable<br><small>Error: ${error.message}</small></div>`;
                dropdown.style.display = 'block';
            });
    }

    function displayDebugResults(products) {
        const results = document.getElementById('debugSearchResults');
        const dropdown = document.getElementById('debugSearchDropdown');

        if (products.length === 0) {
            results.innerHTML = '<div class="dropdown-item-text text-muted p-2">No products found</div>';
            dropdown.style.display = 'block';
            return;
        }

        let html = '';
        products.forEach(product => {
            html += `
                <a href="${product.url}" class="dropdown-item d-flex align-items-center p-2" style="text-decoration: none; border-bottom: 1px solid #f0f0f0;">
                    <img src="${product.image}" alt="${product.name}"
                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 10px;">
                    <div class="flex-grow-1">
                        <div class="fw-bold" style="color: #c63e70;">${product.name}</div>
                        <small class="text-muted">${product.category} - PKR ${product.price}</small>
                    </div>
                </a>
            `;
        });

        results.innerHTML = html;
        dropdown.style.display = 'block';
        log(`Displayed ${products.length} search results`);
    }

    // Add enter key support for debug search
    document.getElementById('debugSearchInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performDebugSearch();
        }
    });

    // Initial log
    log('Debug page loaded. Use the buttons above to test API and AJAX functionality.');
</script>
@endsection
