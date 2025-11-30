<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --------------------
// HOME ROUTES
// --------------------
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit', function () {
    return back()->with('success', 'Your message has been received! We will contact you soon.');
})->name('contact.submit');


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

Route::get('/category/{category}', [ProductController::class, 'category'])
    ->name('category.products');






