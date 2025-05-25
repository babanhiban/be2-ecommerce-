<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;


class HomeController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    $products = Products::where('name', 'like', '%' . $query . '%')->paginate(8);

    return view('product.search_result', compact('products', 'query'));
}

}
