<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);
Route::get('subscribers', [\App\Http\Controllers\Backend\SubscriberController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{subscriber}', [\App\Http\Controllers\Backend\SubscriberController::class, 'destroy'])->name('subscribers.destroy');
