<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getProductByType(Request $request, $type)
    {
        $products = Product::where('type', '=', $type)->get();
        return response()->json($products);
    }
    
    public function putProduct(Request $request) {
        Product::where('id', $request->get('id'))->update($request->all());
        $product = Product::find($request->get('id'));
        return response()->json($product);
    }
}
