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
    $userId = auth()->id() ?? session()->getId();
    $selectedCartIds = $request->input('selected_cart_ids', []);

    if (empty($selectedCartIds)) {
        return redirect()->back()->with('error', 'Bạn chưa chọn sản phẩm nào để thanh toán!');
    }

    // Lấy giỏ hàng được chọn
    $cartItems = Cart::with('product')
                ->where('user_id', $userId)
                ->whereIn('id', $selectedCartIds)
                ->get();

    try {
        DB::beginTransaction();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->quantity < $cartItem->quantity) {
                return redirect()->back()->with('error', "Sản phẩm '{$cartItem->product->name}' không đủ hàng.");
            }
        }

        $totalPrice = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $order = Order::create([
            'customer_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total_price' => $totalPrice,
            'payment_method' => 'cod',
            'status' => 'Đang xử lý',
        ]);

        foreach ($cartItems as $cartItem) {
            $cartItem->product->decrement('quantity', $cartItem->quantity);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // ❗ Chỉ xóa các sản phẩm được chọn khỏi giỏ hàng
        Cart::where('user_id', $userId)
            ->whereIn('id', $selectedCartIds)
            ->delete();

        DB::commit();

        return redirect()->route('payment.status')->with('success', 'Đặt hàng thành công!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('payment.status')->with('error', 'Lỗi thanh toán: ' . $e->getMessage());
    }
}
}
