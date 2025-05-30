<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Products;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    public function run(): void
    {
        $products = Products::all(); // lấy toàn bộ product

        Order::all()->each(function ($order) use ($products) {
            $total = 0;

            // Chọn ngẫu nhiên từ 1 đến 3 sản phẩm
            $selectedProducts = $products->random(rand(1, 3));

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 5);
                $price = $product->price; // hoặc lấy một giá trị cố định/giá khuyến mãi
                $total += $quantity * $price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            // Cập nhật lại tổng tiền của order
            $order->total_price = $total;
            $order->save();
        });
    }
}
    