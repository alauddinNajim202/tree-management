<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::get('/products', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('products.index');
