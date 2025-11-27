<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/basket/add/{productsId}', [BasketController::class, 'add'])->name('basket.add');

//Route::get('/products', function () {
 //  return view('products');
//});