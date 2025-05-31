<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return view('cart.cart', [
                'items' => [],
                'checked' => [],
                'total' => 0,
                'selectedTotal' => 0,
                'cartItemsPaginate' => null,
            ]);
        }

        // Lấy giỏ hàng phân trang, 5 sản phẩm / trang
        $cartItemsPaginate = Cart::with('product')
            ->where('user_id', $userId)
            ->paginate(5);

        $checked = session('cart.checked', []);

        $items = [];
        $total = 0;
        $selectedTotal = 0;

        foreach ($cartItemsPaginate as $cartItem) {
            $product = $cartItem->product;
            if (!$product) continue;

            $items[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? '',
                'image' => $product->image,
                'quantity' => $cartItem->quantity,
                'price' => $product->price,
            ];

            $total += $cartItem->quantity * $product->price;

            if (isset($checked[$product->id])) {
                $selectedTotal += $cartItem->quantity * $product->price;
            }
        }

        return view('cart.cart', compact('items', 'checked', 'total', 'selectedTotal', 'cartItemsPaginate'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return back()->with('error', 'Vui lòng đăng nhập để cập nhật giỏ hàng.');
        }

        $checked = $request->input('checked', []);
        $action = $request->input('action');

        session(['cart.checked' => $checked]);

        $cartItemsQuery = Cart::where('user_id', $userId);
        $cartItems = $cartItemsQuery->get()->keyBy('product_id');

        if ($action) {
            if (str_starts_with($action, 'increase-')) {
                $productId = (int)substr($action, 9);
                if (isset($cartItems[$productId])) {
                    $cart = $cartItems[$productId];
                    
                    // Lấy thông tin sản phẩm để kiểm tra số lượng tồn kho
                    $product = Products::find($productId);
                    
                    if (!$product) {
                        return back()->with('error', 'Sản phẩm không tồn tại.');
                    }
                    
                    // Kiểm tra số lượng tồn kho
                    if ($cart->quantity >= $product->quantity) {
                        return back()->with('error', 'Không thể tăng số lượng. Số lượng trong giỏ hàng đã đạt tối đa (' . $product->stock . ' sản phẩm có sẵn).');
                    }
                    
                    $cart->quantity++;
                    $cart->save();
                    
                    return back()->with('success', 'Đã tăng số lượng sản phẩm.');
                }
            } elseif (str_starts_with($action, 'decrease-')) {
                $productId = (int)substr($action, 9);
                if (isset($cartItems[$productId])) {
                    $cart = $cartItems[$productId];
                    $cart->quantity = max(1, $cart->quantity - 1);
                    $cart->save();
                    
                    return back()->with('success', 'Đã giảm số lượng sản phẩm.');
                }
            } elseif ($action === 'delete') {
                foreach ($checked as $productId => $val) {
                    if (isset($cartItems[$productId])) {
                        $cartItems[$productId]->delete();
                    }
                }
                session(['cart.checked' => []]);

                // Tính lại tổng sản phẩm sau khi xóa
                $newTotal = Cart::where('user_id', $userId)->count();

                $perPage = 5; // số sản phẩm trên mỗi trang
                $currentPage = $request->input('page', 1);

                // Tính tổng trang hiện tại
                $lastPage = (int) ceil($newTotal / $perPage);

                // Nếu trang hiện tại vượt quá tổng trang, redirect về trang cuối cùng tồn tại
                if ($currentPage > $lastPage && $lastPage > 0) {
                    return redirect()->route('cart.index', ['page' => $lastPage])
                        ->with('success', 'Xóa sản phẩm thành công và chuyển về trang phù hợp.');
                }

                // Nếu hết sản phẩm, redirect về trang đầu
                if ($newTotal == 0) {
                    return redirect()->route('cart.index')
                        ->with('success', 'Giỏ hàng trống.');
                }

                // Nếu không cần chuyển trang, quay lại trang hiện tại
                return redirect()->route('cart.index', ['page' => $currentPage])
                    ->with('success', 'Xóa sản phẩm thành công.');
            } elseif ($action === 'buy') {
                if (empty($checked)) {
                    return back()->with('error', 'Vui lòng chọn ít nhất một sản phẩm để mua.');
                }

                // Lấy các sản phẩm được chọn
                $selectedItems = [];
                $totalAmount = 0;

                foreach ($checked as $productId => $val) {
                    if (isset($cartItems[$productId])) {
                        $cart = $cartItems[$productId];
                        $selectedItems[] = $cart;
                        $totalAmount += $cart->quantity * $cart->product->price;
                    }
                }

                if (empty($selectedItems)) {
                    return back()->with('error', 'Sản phẩm đã chọn không hợp lệ.');
                }

                // Lưu dữ liệu sản phẩm đã chọn vào session để dùng trang thanh toán
                session(['checkout.items' => $selectedItems]);

                // Chuyển hướng đến trang thanh toán
                return redirect()->route('checkout.show');
            }
        }

        return back();
    }
    
    public function add($productId, Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ.');
        }

        // Lấy thông tin sản phẩm để kiểm tra số lượng tồn kho
        $product = Products::find($productId);
        
        if (!$product) {
            return back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Kiểm tra số lượng tồn kho trước khi tăng
            if ($cartItem->quantity >= $product->quantity) {
                return back()->with('error', 'Không thể thêm sản phẩm. Số lượng trong giỏ hàng đã đạt tối đa (' . $product->quantity . ' sản phẩm có sẵn).');
            }
            
            // Tăng số lượng nếu đã có và còn hàng
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Kiểm tra tồn kho trước khi tạo mới
            if ($product->quantity <= 0) {
                return back()->with('error', 'Sản phẩm đã hết hàng.');
            }
            
            // Tạo mới item giỏ hàng
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }
     public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        
        if ($request->input('action') === 'increase') {
            $cartItem->increment('quantity');
        } elseif ($request->input('action') === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }
        
        return response()->json(['success' => true]);
    }
}