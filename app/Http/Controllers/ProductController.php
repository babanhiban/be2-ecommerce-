<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function create()
    {
        $categories = Category::all(); // Lấy danh sách danh mục từ DB
        return view('product.addProduct', compact('categories')); // Truyền sang view
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Xử lý upload hình
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); // đặt tên file để tránh trùng
            $destinationPath = public_path('images/manhinhsanpham'); // đường dẫn đến thư mục public/images/manhinhsanpham

            // Di chuyển file vào thư mục
            $file->move($destinationPath, $fileName);

            $validated['image'] = $fileName; // lưu tên file vào DB
        } else {
            // Nếu không có hình thì gán ảnh mặc định
            $validated['image'] = 'logo.jpg'; // Đảm bảo file này có tồn tại trong images/manhinhsanpham
        }

        Products::create($validated); // Tạo sản phẩm

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công!');
    }
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
