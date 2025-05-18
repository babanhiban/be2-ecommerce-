<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
   public function showProducts($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('product.categoryId_Product', compact('category'));
    }
}
