<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
{
    
    $products = Products::all();
    $categories = Category::all(); // ✅ Lấy danh mục

    $user = null;
    if (Auth::check()) {
        $user = Auth::user();
        $user->load('roles');
    }

    return view('homepage', compact('products', 'categories', 'user'));
}

}
