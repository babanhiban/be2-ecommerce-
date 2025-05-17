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
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('category')->insert([
            [
                'name' => 'Lap top',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('category')->insert([
            [
                'name' => 'Máy Ảnh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Tai nghe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Màn Hình',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Chuột máy tính',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
         DB::table('category')->insert([
            [
                'name' => 'Phụ Kiện Khác',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
