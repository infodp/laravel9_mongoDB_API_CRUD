<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return response()->json([
            "result" => $products
        ], Response::HTTP_OK);
    }
    
    public function store(Request $request) {
        $product = new Product();

        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();

        return response()->json(['result'=>$product], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($request->id);

        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();

        return response()->json(['result'=>$product], Response::HTTP_OK);
    }

    public function destroy($id) 
    {
        Product::destroy($id);
        return response()->json(['message'=> "Deleted"], Response::HTTP_OK);
    }
}
