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

// Route::get('/products/{id}', function ($id) {
//     $product = Products::find($id); // Fetch product by ID
//     if (!$product) {
//         return response()->json(['message' => 'Product not found'], 404);
//     }
//     return response()->json($product);
// });

Route::post('/products', [ProductController::class, 'store']);
//Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/api/product_card', [ProductController::class, 'display_card']);


Route::get('/all_products', function() {
    return view('product_gallery');
});