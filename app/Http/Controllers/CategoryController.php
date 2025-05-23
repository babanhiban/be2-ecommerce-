<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function showProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->paginate(8);

        return view('product.categoryId_Product', compact('category', 'products'));
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }
     public function index()
    {
        return Category::select('id', 'name')->get();
    }

    public function getProducts($id)
    {
        return Products::where('category_id', $id)
            ->select('id', 'name', 'price')
            ->get();
    }
}
