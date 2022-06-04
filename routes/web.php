<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/products', [])
// Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);