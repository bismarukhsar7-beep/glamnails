<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;


// --------------------
// HOME ROUTE
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


Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');


// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add to Cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Update Cart Item
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Remove Cart Item  ← **updated: no {id} required**
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Clear Entire Cart
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
// Checkout page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Checkout – place order
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

Route::get('/products/search', [\App\Http\Controllers\ProductController::class, 'search'])
    ->name('products.search');

Route::get('/thank-you', function () {
    return view('checkout.thankyou');
})->name('thankyou');

Route::get('/products/category/{category}', [ProductController::class, 'category'])
    ->name('products.category');



