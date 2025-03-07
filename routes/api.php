<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([HandleCors::class])->group(function () {
});

Route::post('/save_products', [ProductController::class, 'store']);

Route::get('/display_products', [ProductController::class, 'index']);
