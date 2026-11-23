<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// Головна сторінка
Route::get('/', function () {
    return redirect()->route('product.index');
});

// ЗАХИЩЕНІ МАРШРУТИ (доступні лише автентифікованим користувачам)
Route::middleware('auth')->group(function () {
    // Адміністрування товарів та блогу (обов'язково ДО маршрутів з {product} та {blog})
    Route::get('/product/admin', [ProductController::class, 'admin'])->name('product.admin');
    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');

    // Керування товарами (створення, редагування, оновлення, видалення)
    Route::resource('product', ProductController::class)->except(['index', 'show']);

    // Керування записами блогу (створення, редагування, оновлення, видалення)
    Route::resource('blog', BlogController::class)->except(['index', 'show']);

    // Список користувачів системи
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Маршрути профілю Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Публічні маршрути магазину комп'ютерної техніки (доступні всім)
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Публічні маршрути блогу (доступні всім)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

// Маршрут статистики
Route::get('/statistics', [StatsController::class, 'index'])->name('statistics.index');

// Dashboard від Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Маршрути автентифікації Breeze (login, register, logout тощо)
require __DIR__.'/auth.php';
