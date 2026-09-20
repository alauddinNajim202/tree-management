<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);
Route::resource('sliders', \App\Http\Controllers\Backend\SliderController::class);
Route::get('subscribers', [\App\Http\Controllers\Backend\SubscriberController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{subscriber}', [\App\Http\Controllers\Backend\SubscriberController::class, 'destroy'])->name('subscribers.destroy');

// Admin Orders
Route::get('orders', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('orders');
Route::get('orders/{id}', [\App\Http\Controllers\Backend\OrderController::class, 'show'])->name('orders.show');
Route::post('orders/{id}/status', [\App\Http\Controllers\Backend\OrderController::class, 'updateStatus'])->name('orders.status');

// Settings
Route::get('/settings', [\App\Http\Controllers\Backend\SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [\App\Http\Controllers\Backend\SettingController::class, 'update'])->name('settings.update');

// Inventory
Route::get('/inventory', [\App\Http\Controllers\Backend\InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/update', [\App\Http\Controllers\Backend\InventoryController::class, 'update'])->name('inventory.update');
