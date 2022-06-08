<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index']);
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::middleware('pin')->group(function() {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\ProductController::class, 'create']);
    Route::get('/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit']);
    Route::get('/all-stocks', [App\Http\Controllers\ProductController::class, 'allStocks']);
    Route::get('/out-of-stock', [App\Http\Controllers\ProductController::class, 'outOfStock']);
    Route::get('/sale', [App\Http\Controllers\SaleController::class, 'index']);
    
    Route::post('/store', [App\Http\Controllers\ProductController::class, 'store']);
    Route::post('/update/{product}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::post('/sale/create', [App\Http\Controllers\SaleController::class, 'store']);
    Route::post('/sale/add-service/{sale}', [App\Http\Controllers\SaleController::class, 'addServiceFee']);
    Route::post('/sale/confirm/{sale}', [App\Http\Controllers\SaleController::class, 'confirm']);
    Route::post('/sale/add-product/{sale}/{product}', [App\Http\Controllers\SaleController::class, 'addProduct']);
    Route::post('/sale/remove-product/{sale}/{product}', [App\Http\Controllers\SaleController::class, 'removeProduct']);
    Route::get('/sale/print/{sale}', [App\Http\Controllers\SaleController::class, 'print']);
    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
});
