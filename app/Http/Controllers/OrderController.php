<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Products; 
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderByDesc('created_at')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'status'        => 'required|string|in:Đang xử lý,Đang giao,Hoàn thành,Đã huỷ',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'voucher_id'    => 'nullable|exists:vouchers,id', // dùng code nhưng trả về id
        ]);

        $product = Products::findOrFail($validated['product_id']);
        $total = $product->price * $validated['quantity'];

        $voucher = null;

        if ($validated['voucher_id']) {
            $voucher = Voucher::where('id', $validated['voucher_id'])
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();

            if (!$voucher) {
                return response()->json([
                    'message' => 'Mã voucher không hợp lệ hoặc đã hết hạn.'
                ], 422);
            }

            $total *= (1 - $voucher->discount / 100);
        }

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'phone'         => $validated['phone'],
            'address'       => $validated['address'],
            'status'        => $validated['status'],
            'total_price'   => $total,
            'voucher_id'    => $voucher?->id,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => $validated['quantity'],
            'price'      => $product->price,
        ]);

        return response()->json(['message' => 'Đã tạo đơn hàng']);
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

        return response()->json([
            'message' => 'Cập nhật thành công',
            'order' => $order
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Đơn hàng đã được xoá.']);
    }

    public function show($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);

        return response()->json([
            'customer_name' => $order->customer_name,
            'phone' => $order->phone,
            'address' => $order->address,
            'status' => $order->status,
            'total_price' => $order->total_price,
            'products' => $order->items->map(function ($item) {
                return [
                    'name' => optional($item->product)->name ?? '(Không tồn tại)',
                    'quantity' => $item->quantity,
                ];
            }),
        ]);
    }


}
