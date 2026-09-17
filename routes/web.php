<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [\App\Http\Controllers\Web\HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/category', [\App\Http\Controllers\Web\CategoryController::class, 'index'])->name('category');

Route::get('/product/{slug}', [\App\Http\Controllers\Web\HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/shopping-cart', [\App\Http\Controllers\Web\HomeController::class, 'shoppingCart'])->name('shopping-cart');
Route::get('/checkout', [\App\Http\Controllers\Web\HomeController::class, 'checkout'])->name('checkout');

Route::get('/blog', [\App\Http\Controllers\Web\HomeController::class, 'blog'])->name('blog');
Route::get('/blog-details', [\App\Http\Controllers\Web\HomeController::class, 'blogDetails'])->name('blog-details');
Route::get('/contact', [\App\Http\Controllers\Web\HomeController::class, 'contact'])->name('contact');
Route::get('/faq', [\App\Http\Controllers\Web\HomeController::class, 'faq'])->name('faq');
Route::get('/my-wishlist', [\App\Http\Controllers\Web\HomeController::class, 'myWishlist'])->name('my-wishlist');
Route::get('/product-comparison', [\App\Http\Controllers\Web\HomeController::class, 'productComparison'])->name('product-comparison');

Route::get('/terms-conditions', [\App\Http\Controllers\Web\HomeController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/track-orders', [\App\Http\Controllers\Web\HomeController::class, 'trackOrders'])->name('track-orders');
Route::get('/404', [\App\Http\Controllers\Web\HomeController::class, 'notFound'])->name('404');
Route::post('/subscribe', [\App\Http\Controllers\Web\SubscriberController::class, 'store'])->name('subscribe');
