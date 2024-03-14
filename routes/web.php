<?php

use App\Livewire\Admin\Product as AdminProduct;
use Illuminate\Support\Facades\Route;
use App\Livewire\Customer\Product;
use App\Livewire\Customer\Product\Cart;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('products')->middleware('auth')->group(function () {
    Route::get('/', Product\Index::class)->name('customer.product.index');
});

Route::get('cart', Cart\Index::class)->middleware('auth')->name('cart');

ROute::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', AdminProduct\Index::class)->name('admin.product.index');
    });

});
require __DIR__.'/auth.php';
