<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Customer\Product;

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
require __DIR__.'/auth.php';
