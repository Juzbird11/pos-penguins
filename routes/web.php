<?php

use Illuminate\Support\Facades\Route;

\URL::forceScheme('https');

Route::get('/', function () {
    return view('welcome');
});
