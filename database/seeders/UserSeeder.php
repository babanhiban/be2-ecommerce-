<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Xóa toàn bộ dữ liệu cũ trong bảng users
        DB::table('users')->truncate();
        //Insert data
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin123@'),
                'remember_token' => Str::random(10),
                'phone' => '0123456789',
                'gioitinh' => 'Nam',
                'address' => '123 Nguyễn Trãi, Hà Nội',
                'ngaysinh' => '1990-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Thêm các user giả lập

        for ($i = 2; $i < self::MAX_RECORDS; $i++) {
            DB::table('users')->insert([
                [
                    'name' => 'user' . $i,
                    'email' => "admin{$i}@gmail.com",
                    'email_verified_at' => now(),
                    'password' => Hash::make('User123@'),
                    'remember_token' => Str::random(10),
                    'phone' => '09' . rand(10000000, 99999999),
                    'gioitinh' => rand(0, 1) ? 'Nam' : 'Nữ',
                    'address' => 'Số ' . rand(1, 999) . ' Đường 3/2, Quận ' . rand(1, 12) . ', TP.HCM',
                    'ngaysinh' => now()->subYears(rand(18, 40))->subDays(rand(0, 365))->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
