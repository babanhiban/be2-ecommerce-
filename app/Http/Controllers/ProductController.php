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
public function deleteProduct(Request $request)
    {
        $product_id = $request->get('id');
        $product = Products::destroy($product_id);


        // Quay lại trang danh sách sau khi xóa thành công
        return redirect()->route('admin.products')->withSuccess('User deleted successfully');

        // $user_id = $request->get('id');
        // $user = User::destroy($user_id);

        // return redirect("list")->withSuccess('You have signed-in');
    }   
    //  public function updateUser(Request $request)
    // {
    //     $product_id = $request->get('id');
    //     $product = Products::find($product_id);

    //     return view('admin.crud_users', ['product' => $product]);
    // }
     public function listProduct()
    {
        return view('admin.list_products', [
            
            'products' => Products::with('category')->paginate(5)
        ]);   
    }
}
