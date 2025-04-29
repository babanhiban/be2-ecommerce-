<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'code' => 'DH' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                'customer_name' => $order->user->name ?? 'Chưa có',
                'created_at' => Carbon::parse($order->created_at)->format('d/m/Y'),
                'status' => $order->status,
                'total_price' => $order->total_price,
            ];
        });

        return Inertia::render('Orders/Index', [
            'orders' => $orders,
        ]);
    }
}
