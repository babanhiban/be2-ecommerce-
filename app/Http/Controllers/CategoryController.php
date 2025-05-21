<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Products;

class CategoryController extends Controller
{
    //
   public function showProducts($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('product.categoryId_Product', compact('category'));
    }
    public function index()
    {
        return response()->json(Category::all());
    }
    public function getProducts($id)
{
    try {
        $products = Products::where('category_id', $id)->get();
        return response()->json($products);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
