<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Items
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::post('/items/{item}/categories', [ItemController::class, 'attachCategory'])->name('items.attachCategory');
Route::delete('/items/{item}/categories', [ItemController::class, 'detachCategory'])->name('items.detachCategory');

// Contracts
Route::get('/items/{item}/borrow', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/items/{item}/borrow', [ContractController::class, 'store'])->name('contracts.store');
Route::post('/contracts/{contract}/accept', [ContractController::class, 'accept'])->name('contracts.accept');
Route::post('/contracts/{contract}/reject', [ContractController::class, 'reject'])->name('contracts.reject');
Route::post('/contracts/{contract}/return', [ContractController::class, 'return'])->name('contracts.return');

// Reviews
Route::get('/users/{user}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/users/{user}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/users/{user}/reviews', [ReviewController::class, 'show'])->name('reviews.show');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
