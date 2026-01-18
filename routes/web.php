<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Shop\Home;
use App\Livewire\Admin\Products\Index as ProductIndex;
use App\Livewire\Admin\Products\Create as ProductCreate;
use App\Livewire\Admin\Products\Edit as ProductEdit;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Retailer\Dashboard as RetailerDashboard;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsRetailer;

Route::get('/', Home::class)->name('home');
Route::get('/catalog', \App\Livewire\Shop\Catalog::class)->name('catalog');
Route::get('/product/{product}', \App\Livewire\Shop\ProductShow::class)->name('product.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified', EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/products', ProductIndex::class)->name('products.index');
        Route::get('/products/create', ProductCreate::class)->name('products.create');
        Route::get('/products/{product}/edit', ProductEdit::class)->name('products.edit');

        Route::get('/orders', \App\Livewire\Admin\Orders\Index::class)->name('orders.index');
        Route::get('/orders/{order}', \App\Livewire\Admin\Orders\Show::class)->name('orders.show');
    });

Route::middleware(['auth', 'verified', EnsureUserIsRetailer::class])
    ->prefix('retailer')
    ->name('retailer.')
    ->group(function () {
        Route::get('/dashboard', RetailerDashboard::class)->name('dashboard');
    });

require __DIR__ . '/auth.php';
