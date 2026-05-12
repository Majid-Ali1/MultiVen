<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public Storefront
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{orderNumber}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/verify', function () {
    return view('auth.pending');
})->name('verification.notice');

Route::get('/suspended', function () {
    return view('auth.suspended');
})->name('account.suspended');

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    
    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::get('/vendors', [\App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendors.index');
        Route::post('/vendors/{vendor}/suspend', [\App\Http\Controllers\Admin\VendorController::class, 'suspend'])->name('vendors.suspend');
        Route::post('/vendors/{vendor}/activate', [\App\Http\Controllers\Admin\VendorController::class, 'activate'])->name('vendors.activate');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::post('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users/{user}/suspend', [\App\Http\Controllers\Admin\UserController::class, 'suspend'])->name('users.suspend');
        Route::post('/users/{user}/activate', [\App\Http\Controllers\Admin\UserController::class, 'activate'])->name('users.activate');
        Route::get('/commissions', [\App\Http\Controllers\Admin\CommissionController::class, 'index'])->name('commissions.index');
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

    // Vendor Routes
    Route::middleware(['role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/products/catalog', [\App\Http\Controllers\Vendor\ProductController::class, 'catalog'])->name('products.catalog');
        Route::post('/products/import', [\App\Http\Controllers\Vendor\ProductController::class, 'import'])->name('products.import');
        Route::patch('/products/{product}/price', [\App\Http\Controllers\Vendor\ProductController::class, 'updatePrice'])->name('products.updatePrice');
        Route::get('/products', [\App\Http\Controllers\Vendor\ProductController::class, 'index'])->name('products.index');
        Route::delete('/products/{product}', [\App\Http\Controllers\Vendor\ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/orders', [\App\Http\Controllers\Vendor\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [\App\Http\Controllers\Vendor\OrderController::class, 'show'])->name('orders.show');

        Route::get('/settings', [\App\Http\Controllers\Vendor\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Vendor\SettingController::class, 'update'])->name('settings.update');
        Route::post('/settings/token', [\App\Http\Controllers\Vendor\SettingController::class, 'generateToken'])->name('settings.token');
    });

    // Partner Routes
    Route::middleware(['role:partner'])->prefix('partner')->name('partner.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Partner\DashboardController::class, 'index'])->name('dashboard');
    });

    // Customer Routes
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    });
});
