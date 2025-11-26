<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordChangeController;
use Illuminate\Support\Facades\Route;

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

});

require __DIR__.'/auth.php';
