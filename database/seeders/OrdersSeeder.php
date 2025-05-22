<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

        for ($i = 1; $i <= self::MAX_ORDERS; $i++) {
            $user = $users->random();

            DB::table('orders')->insert([
                'user_id'       => $user->id,
                'customer_name' => $user->name,
                'phone'         => $user->phone ?? '09' . rand(10000000, 99999999),
                'address'       => 'Số ' . rand(1, 100) . ', Đường ' . Str::random(5) . ', Q.' . rand(1, 12) . ', TP.HCM',
                'total_price'   => rand(100000, 10000000),
                'status'        => collect(['Chờ xử lý', 'Đang giao', 'Đã giao', 'Đã hủy'])->random(),
                'created_at'    => now()->subDays(rand(0, 30)),
                'updated_at'    => now()
            ]);
        }
    }
}
