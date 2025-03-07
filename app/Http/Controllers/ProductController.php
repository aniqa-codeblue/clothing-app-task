<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request){
         //dd()
       $validator = Validator::make($request -> all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'size' => 'required',
            'color' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        //$sizes = is_array($request->input('size')) ? $request->input('size') : explode(',', $request->input('size'));
        //$colors = is_array($request->input('color')) ? $request->input('color') : explode(',', $request->input('color'));

        // $imagePaths = [];
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('products', 'public'); 
        //         $imagePaths[] = "storage/$path"; // Use correct format
        //     }
        // }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle image uploads
        $imageData = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Get original filename
                $originalName = $image->getClientOriginalName();
                
                // Store the file in storage/app/public/products
                $path = $image->storeAs('products', $originalName, 'public');
                
                // Add to image data array with original name and path
                $imageData[] = $originalName;
            }
        }

        $product = Products::create([

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'size' => json_encode($request->input('size'), JSON_UNESCAPED_SLASHES),
            'color' => json_encode($request->input('color'), JSON_UNESCAPED_SLASHES),
            'images' => json_encode($imageData, JSON_UNESCAPED_SLASHES),
        ]);

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    public function index() {

        $products = Products::all();

        $products->each(function ($product) {
            $product->size = json_decode($product->size);
            $product->color = json_decode($product->color);
            $product->images = json_decode($product->images);
        });
        return response()->json($products);
    }
}
