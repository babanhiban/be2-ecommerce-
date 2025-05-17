<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category')->insert([
            [
                'name' => 'ĐĐiện thoại',
                'image' => 'dienthoai.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('category')->insert([
            [
                'name' => 'Lap top',
                'image' => 'laptop.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('category')->insert([
            [
                'name' => 'Máy Ảnh',
                'image' => 'mayanh.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Tai nghe',
                'image' => 'tainghe.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Màn Hình',
                'image' => 'manhinh.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Chuột máy tính',
                'image' => 'chuotmaytinh.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Phụ Kiện Khác',
                'image' => 'phukien.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
