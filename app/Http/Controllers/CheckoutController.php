<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
class CheckoutController extends Controller
{
    public function show()
{
    $user = Auth::user();
    $cartItems  = session('checkout.items', []);

    if (empty($cartItems )) {
        return redirect()->route('cart.cart')->with('error', 'Không có sản phẩm để thanh toán.');
    }

    return view('payment.checkout', compact('user', 'cartItems'));
}

public function buyNow(Request $request)
{
    $product = Products::findOrFail($request->product_id);

    $cartItem = (object)[
        'product' => $product,
        'quantity' => $request->input('quantity', 1),
    ];

    $user = Auth::user(); // nếu đang dùng xác thực

    return view('payment.checkout', [
        'cartItems' => [$cartItem],
        'user' => $user,
    ]);
}
public function process(Request $request) 
{
    // Lấy giỏ hàng từ database với relationship
    $userId = auth()->id() ?? session()->getId();
    $cartItems = Cart::with('product')
                    ->where('user_id', $userId)
                    ->get();
    
    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Giỏ hàng trống!');
    }

    try {
        DB::beginTransaction();
        
        // Kiểm tra tồn kho trước khi tạo đơn hàng
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->quantity < $cartItem->quantity) {
                return redirect()->back()->with('error', "Sản phẩm '{$cartItem->product->name}' không đủ hàng trong kho. Hiện còn: {$cartItem->product->quantity}");
            }
        }

        // Tính tổng tiền sử dụng relationship
        $totalPrice = $cartItems->sum(function($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Tạo đơn hàng
        $order = Order::create([
            'customer_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total_price' => $totalPrice,
            'payment_method' => 'cod',
            'status' => 'pending',
        ]);

        // Trừ kho và tạo chi tiết đơn hàng
        foreach ($cartItems as $cartItem) {
            // Trừ kho
            $cartItem->product->decrement('quantity', $cartItem->quantity);
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        DB::commit();
        
        // Xóa giỏ hàng
        Cart::where('user_id', $userId)->delete();
        
        return redirect()->route('payment.status')->with('success', 'Đặt hàng thành công! Mã đơn hàng: #' . $order->id);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('payment.status')->with('error', 'Lỗi thanh toán: ' . $e->getMessage());
    }
}
}
