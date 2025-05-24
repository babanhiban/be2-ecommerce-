<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OrdersSeeder extends Seeder
{
    const MAX_ORDERS = 50;

    public function run(): void
    {
        // Xóa dữ liệu cũ
        DB::table('orders')->truncate();

        $users = User::all();

        if ($users->count() === 0) {
            $this->command->warn('Không có user nào trong bảng users.');
            return;
        }

        $orders = [];

        for ($i = 1; $i <= self::MAX_ORDERS; $i++) {
            $user = $users->random();

            $orders[] = [
                'user_id'       => $user->id,
                'customer_name' => $user->name,
                'phone'         => $user->phone ?? '09' . rand(10000000, 99999999),
                'address'       => $user->address ?? 'Chưa cập nhật',
                'total_price'   => rand(100000, 10000000),
                'status'        => collect(['Đang xử lý', 'Đang giao', 'Hoàn thành', 'Đã hủy'])->random(),
                'created_at'    => now()->subDays(rand(0, 30)),
                'updated_at'    => now()
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
