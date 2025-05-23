<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

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
}
