<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/password/change', [PasswordChangeController::class, 'showForm'])
        ->name('password.change.form');

    Route::post('/password/change', [PasswordChangeController::class, 'update'])
        ->name('password.change.update');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

});

require __DIR__ . '/auth.php';

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Basket routes
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add/{productId}', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{productId}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{productId}', [BasketController::class, 'remove'])->name('basket.remove');
Route::delete('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');

// About Us page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Us routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');