<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function stores_product(Request $request){
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

        //D:\productshoptask\storage\app\public\Images
        // Handle image uploads
        $imageData = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Get original filename
                $originalName = $image->getClientOriginalName();
                
                // Store the file in storage\app\public\products
                $path = $image->move('Images', $originalName);
                
                // Add to image data array with original name and path
                $imageData[] = ['name' => $originalName];
            }
        } 

        $product = Products::create([$request->all()]);

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    public function index() {
        $products = Products::all();
        
        // Parse JSON fields for each product
        $products->each(function ($product) {
            $product->size = json_decode($product->size, TRUE);
            $product->color = json_decode($product->color, TRUE);
            $product->images = json_decode($product->images, TRUE);
        });
        
        return response()->json($products);
    }

    public function show($id) {

        $product = Products::findOrFail($id);

        // $products->each(function ($product) {
        //     $product->size = json_decode($product->size, TRUE);
        //     $product->color = json_decode($product->color, TRUE);
        //     $product->images = json_decode($product->images, TRUE);
        // });
        return view('product_card', compact('product'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_name' => 'required|string|max:255',
            'product_image' => 'required|string',
            'product_price' => 'required|numeric',
            'selected_color' => 'required|string|max:50',
            'selected_size' => 'required|string|max:10',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new product
        $product = Products::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
            'data' => $product
        ], 201);
    }

    public function display_card()
    {
        $products = Products::select('name', 'description', 'images')->get();
        return response()->json($products);
    }
}
