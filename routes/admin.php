<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);
Route::get('subscribers', [\App\Http\Controllers\Backend\SubscriberController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{subscriber}', [\App\Http\Controllers\Backend\SubscriberController::class, 'destroy'])->name('subscribers.destroy');

// Admin Orders
Route::get('orders', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('orders');
Route::get('orders/{id}', [\App\Http\Controllers\Backend\OrderController::class, 'show'])->name('orders.show');
Route::post('orders/{id}/status', [\App\Http\Controllers\Backend\OrderController::class, 'updateStatus'])->name('orders.status');
