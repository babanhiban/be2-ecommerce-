<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductApiController extends Controller
{
    public function getByCategory($categoryId)
    {
        $products = Products::where('category_id', $categoryId)->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json($product);
    }
}
