<?php

use App\Livewire\Admin\ReviewApplyRetailer;
use App\Livewire\App\ApplyToRetailer;
use App\Livewire\App\UserAccounts;
use App\Livewire\App\UserAddress;
use App\Livewire\App\UserDashboard;
use App\Livewire\App\UserMyOrder;
use App\Livewire\App\UserOrderView;
use App\Livewire\App\UserProfile;
use App\Livewire\App\UserWishlist;
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
Route::get('/checkout', \App\Livewire\Shop\Checkout::class)->name('checkout');
Route::get('/order-success/{order}', \App\Livewire\Shop\OrderSuccess::class)->name('ordersuccess');
Route::get('/product/{product}', \App\Livewire\Shop\ProductShow::class)->name('product.show');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', UserDashboard::class)->name('dashboard');
    Route::get('my-orders', UserMyOrder::class)->name('myorders');
    Route::get('my-addresses', UserAddress::class)->name('myaddresses');
    Route::get('profile', UserProfile::class)->name('profile');
    Route::get('wishlist', UserWishlist::class)->name('wishlist');
    Route::get('order-view/{order}', UserOrderView::class)->name('orderview');
    Route::get('apply-to-retailer', ApplyToRetailer::class)->name('applytoretailer');
    Route::get('accounts', UserAccounts::class)->name('accounts');

});
// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

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
        Route::get('/review-retailer', ReviewApplyRetailer::class)->name('reviewretailer');
    });

Route::middleware(['auth', 'verified', EnsureUserIsRetailer::class])
    ->prefix('retailer')
    ->name('retailer.')
    ->group(function () {
        Route::get('/dashboard', RetailerDashboard::class)->name('dashboard');
    });

require __DIR__ . '/auth.php';
