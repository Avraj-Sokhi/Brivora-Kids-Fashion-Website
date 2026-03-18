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
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/password/change', [PasswordChangeController::class, 'showForm'])
        ->name('password.change.form');

    Route::post('/password/change', [PasswordChangeController::class, 'update'])
        ->name('password.change.update');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('pages.dashboard');
    })->name('admin.dashboard');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('reviews', [App\Http\Controllers\ReviewController::class, 'store'])
    ->name('reviews.store');
    Route::post('/orders/{order}/return', [OrderController::class, 'requestReturn'])
    ->name('orders.return');

    // Admin Order Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/orders', [App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [App\Http\Controllers\Admin\AdminOrderController::class, 'update'])->name('orders.update');
    });

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

//Chatbot
Route::post('/chatbot/message', [ChatbotController::class, 'handle'])->name('chatbot.handle');

// About Us page
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact Us routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');