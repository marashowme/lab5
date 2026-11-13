<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('product.index');
});

// Маршрути для країн (з лабораторної)
Route::resource('country', CountryController::class);

// Маршрути для магазину техніки (ваше індивідуальне)
// Маршрут адміністрування ПЕРЕД resource, інакше /product/admin
// буде сприйнято як /product/{product} (метод show)
Route::get('/product/admin', [ProductController::class, 'admin'])->name('product.admin');
Route::resource('product', ProductController::class);

// Маршрути блогу
// Маршрут адміністрування ПЕРЕД resource, інакше /blog/admin
// буде сприйнято як /blog/{blog} (метод show)
Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
Route::resource('blog', BlogController::class);

// Маршрути статистики відвідувань
Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
