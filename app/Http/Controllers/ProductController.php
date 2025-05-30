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
    public function edit($id)
    {
        // Tìm sản phẩm theo id
        $product = Products::findOrFail($id);
        $categories = Category::all();

        // Trả về view sửa với dữ liệu sản phẩm
        return view('product.editProduct', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        // Cập nhật thông tin cơ bản
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');

        // ✅ Xử lý hình ảnh nếu người dùng upload mới
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/manhinhsanpham'), $filename);

            //Xoá ảnh cũ nếu muốn
            if ($product->image && file_exists(public_path('images/manhinhsanpham/' . $product->image))) {
                unlink(public_path('images/manhinhsanpham/' . $product->image));
            }

            // Lưu tên ảnh mới vào DB
            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Products::where('name', 'like', '%' . $query . '%')->paginate(5);

        return view('admin.list_products', compact('products'));
    }
public function show($id)
    {
    // Lấy product theo id, hoặc fail 404 nếu không tồn tại
        $product = Products::findOrFail($id);
        return view('product.productDetail', compact('product'));
    }

    
}


