<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendorApiController;

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('/products', [VendorApiController::class, 'products']);
    Route::post('/orders', [VendorApiController::class, 'createOrder']);
});
