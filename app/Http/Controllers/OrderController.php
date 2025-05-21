<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
       $orders = Order::with('user')->orderByDesc('created_at')->get();
    return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            // thêm các trường khác nếu có
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo.');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            // thêm các trường khác nếu có
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được cập nhật.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xoá.');
    }
    public function show($id)
{
    $order = Order::findOrFail($id);

    return response()->json([
        'customer_name' => $order->customer_name,
        'phone' => $order->phone,
        'address' => $order->address,
        'status' => $order->status,
        'total_price' => $order->total_price,
    ]);
}


}

