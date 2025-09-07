<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
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
});

Route::prefix('transactions')->name('transactions.')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/create', [TransactionController::class, 'create'])->name('create');
    Route::post('/', [TransactionController::class, 'store'])->name('store');
    Route::get('/{transaction}', [TransactionController::class, 'show'])->name('show');
    Route::get('{transaction}/edit', [TransactionController::class, 'edit'])->name('edit');
    Route::patch('/{transaction}', [TransactionController::class, 'update'])->name('update');
    Route::delete('{transaction}', [TransactionController::class, 'destroy'])->name('destroy');
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
    Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
