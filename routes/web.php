<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Products;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([HandleCors::class])->group(function () {
});

Route::post('/save_products', [ProductController::class, 'store']);

Route::get('/display_products', [ProductController::class, 'index']);

// Route::get('/product', function () {
//     return view('product_card');
// });

// Route::get('/product/{id}', function ($id) {
//     $product = Products::findOrFail($id);
//     return view('product_card', ['product' => $product]);
// });

Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/all_products', function() {
    return view('product_gallery');
});