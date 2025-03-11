<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class product_Controller extends Controller
{
    /**
     * Store a newly created product in storage.
     */
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
        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
            'data' => $product
        ], 201);
    }
}
