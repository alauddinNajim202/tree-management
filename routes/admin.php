<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);
