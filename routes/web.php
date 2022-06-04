<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/products', [])
Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/in-stock', [App\Http\Controllers\ProductController::class, 'inStock']);
Route::get('/out-of-stock', [App\Http\Controllers\ProductController::class, 'outOfStock']);
Route::get('/sale', [App\Http\Controllers\SaleController::class, 'index']);