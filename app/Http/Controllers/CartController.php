<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id(); // Lấy user hiện tại

        if (!$userId) {
            // Với guest, bạn có thể trả về rỗng hoặc xử lý session (phần này tùy bạn)
            return view('cart.cart', [
                'items' => [],
                'checked' => [],
                'total' => 0,
                'selectedTotal' => 0,
            ]);
        }

        // Lấy cart của user hiện tại, join với product để lấy thông tin sản phẩm
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // Lấy checked từ session (giữ để dùng checkbox)
        $checked = session('cart.checked', []);

        $items = [];
        $total = 0;
        $selectedTotal = 0;

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            if (!$product) continue;

            $items[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? '', // nếu có category relation
                'image' => $product->image,
                'quantity' => $cartItem->quantity,
                'price' => $product->price,
            ];

            $total += $cartItem->quantity * $product->price;

            if (isset($checked[$product->id])) {
                $selectedTotal += $cartItem->quantity * $product->price;
            }
        }

        return view('cart.cart', compact('items', 'checked', 'total', 'selectedTotal'));
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

        // Lấy cart hiện tại
        $cartItems = Cart::where('user_id', $userId)->get()->keyBy('product_id');

        if ($action) {
            if (str_starts_with($action, 'increase-')) {
                $productId = (int)substr($action, 9);
                if (isset($cartItems[$productId])) {
                    $cart = $cartItems[$productId];
                    $cart->quantity++;
                    $cart->save();
                }
            } elseif (str_starts_with($action, 'decrease-')) {
                $productId = (int)substr($action, 9);
                if (isset($cartItems[$productId])) {
                    $cart = $cartItems[$productId];
                    $cart->quantity = max(1, $cart->quantity - 1);
                    $cart->save();
                }
            } elseif ($action === 'delete') {
                foreach ($checked as $productId => $val) {
                    if (isset($cartItems[$productId])) {
                        $cartItems[$productId]->delete();
                    }
                }
                session(['cart.checked' => []]);
            } elseif ($action === 'buy') {
                if (empty($checked)) {
                    return back()->with('error', 'Vui lòng chọn ít nhất một sản phẩm để mua.');
                }

                $names = [];
                $totalAmount = 0;

                foreach ($checked as $productId => $val) {
                    if (isset($cartItems[$productId])) {
                        $cart = $cartItems[$productId];
                        $names[] = $cart->product->name;
                        $totalAmount += $cart->quantity * $cart->product->price;

                        // Xóa sản phẩm sau khi mua
                        $cart->delete();
                    }
                }
                session(['cart.checked' => []]);

                return back()->with('success', "Bạn đã mua " . implode(', ', $names) . " với giá " . number_format($totalAmount, 0, ',', '.') . " VNĐ thành công!");
            }
        }

        return back();
    }
}
