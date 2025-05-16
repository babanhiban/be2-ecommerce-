<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

     public function listProduct()
    {
        return view('admin.list_products', [
            
            'products' => Products::with('category')->paginate(5)
        ]);   
    }
}
