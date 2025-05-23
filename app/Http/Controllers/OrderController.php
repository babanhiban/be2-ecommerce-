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
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'status' => 'required|string|in:Đang xử lý,Đang giao,Hoàn thành,Đã huỷ',
    ]);

    $order->update($validated);

    // Trả về JSON kèm dữ liệu order nếu cần cập nhật DOM nhanh
    return response()->json(['message' => 'Cập nhật thành công', 'order' => $order]);
}


    public function destroy(Order $order)
{
    $order->delete();
    return response()->json(['message' => 'Đơn hàng đã được xoá.']);
}
 public function show($id)
{
    $order = Order::with('items.product')->findOrFail($id);

    return response()->json([
        'customer_name' => $order->customer_name,
        'phone' => $order->phone,
        'address' => $order->address,
        'status' => $order->status,
        'total_price' => $order->total_price,
        'products' => $order->items->map(function ($item) {
            return [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
            ];
        }),
    ]);
}


}

