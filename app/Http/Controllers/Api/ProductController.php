<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function store(Request $request){
        $product = Product::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'price' => $request->price,
        ]);
        // return response()->json(new ProductResource($product),201);
        return response()->json($product,201);

    }

    public function show(int $id){
        $product = Product::findOrfail($id);
        return response()->json(new ProductResource($product));
        

    }
}
