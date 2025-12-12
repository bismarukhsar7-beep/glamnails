<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\AdminMessageController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --------------------
// HOME ROUTES
// --------------------
Route::get('/', function () {
    $categories = Category::orderBy('name')->get();
    return view('pages.home', compact('categories'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit', [ContactMessageController::class, 'store'])
    ->name('contact.submit');


// --------------------
// REVIEWS
// --------------------
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');


// --------------------
// PRODUCTS
// --------------------
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// Debug route for testing API
Route::get('/debug/search', function(Request $request) {
    try {
        $query = $request->get('q', 'nail');
        $products = \App\Models\Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('category', 'LIKE', "%{$query}%")
              ->orWhere('desc', 'LIKE', "%{$query}%");
        })->limit(5)->get();

        return response()->json([
            'success' => true,
            'query' => $query,
            'count' => $products->count(),
            'products' => $products->toArray()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'query' => $request->get('q', 'nail')
        ], 500);
    }
});

// Simple debug page
Route::get('/debug', function() {
    return view('debug');
});

// Test API directly
Route::get('/test-api', function(Request $request) {
    try {
        // Test class loading
        if (!class_exists('\App\Http\Controllers\Api\ProductController')) {
            throw new Exception('API Controller class not found');
        }

        return response()->json([
            'status' => 'Class exists',
            'class' => '\App\Http\Controllers\Api\ProductController'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});

// Test API controller instantiation
Route::get('/test-instantiate', function(Request $request) {
    try {
        $controller = new \App\Http\Controllers\Api\ProductController();

        return response()->json([
            'status' => 'Controller instantiated successfully',
            'class' => get_class($controller)
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});

// Test Product model
Route::get('/test-model', function(Request $request) {
    try {
        $count = \App\Models\Product::count();
        $first = \App\Models\Product::first();

        return response()->json([
            'status' => 'model works',
            'count' => $count,
            'first_product' => $first ? $first->toArray() : null
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});

// Test API with search
Route::get('/test-api-search', function(Request $request) {
    try {
        $query = $request->get('q', 'nail');

        $products = \App\Models\Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('category', 'LIKE', "%{$query}%")
              ->orWhere('desc', 'LIKE', "%{$query}%");
        })->limit(5)->get();

        return response()->json([
            'success' => true,
            'query' => $query,
            'count' => $products->count(),
            'products' => $products->toArray()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

Route::get('/products/category/{category}', [ProductController::class, 'category'])
    ->name('products.category');


// --------------------
// CART ROUTES
// --------------------
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add to cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Update item
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Remove item
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Clear whole cart
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// --------------------
// CHECKOUT
// --------------------
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/checkout/process', [CheckoutController::class, 'process'])
    ->name('checkout.process');

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('checkout.placeOrder');

Route::get('/thank-you', function () {
    return view('checkout.thankyou');
})->name('thankyou');


// --------------------
// ADMIN LOGIN SYSTEM
// --------------------

// Show login page
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Handle login form
Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login.submit');

// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/admin/messages', [AdminController::class, 'messages'])
    ->name('admin.messages');

// Admin orders management
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::post('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');

// Admin messages
Route::get('/admin/messages', [AdminMessageController::class, 'index'])->name('admin.messages');
Route::get('/admin/messages/{id}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
Route::get('/admin/messages/{id}/delete', [AdminMessageController::class, 'destroy'])->name('admin.messages.delete');

// Admin categories CRUD
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
Route::get('/admin/categories/{id}/products', [CategoryController::class, 'products'])->name('admin.categories.products');

// ADMIN LOGOUT
Route::get('/admin/logout', function () {
    session()->forget('admin_id');
    return redirect('/admin/login');
})->name('admin.logout');

// ADMIN PRODUCT CRUD
Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');

// ADMIN REVIEWS CRUD
Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews');
Route::get('/admin/reviews/{id}', [ReviewController::class, 'adminShow'])->name('admin.reviews.show');
Route::get('/admin/reviews/{id}/delete', [ReviewController::class, 'adminDelete'])->name('admin.reviews.delete');

Route::get('/category/{category}', [ProductController::class, 'category'])
    ->name('category.products');






