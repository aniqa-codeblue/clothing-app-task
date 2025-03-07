<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([HandleCors::class])->group(function () {
});

Route::post('/save_products', [ProductController::class, 'store']);

Route::get('/display_products{id}', [ProductController::class, 'index']);

