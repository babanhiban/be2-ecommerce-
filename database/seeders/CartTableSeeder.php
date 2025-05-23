<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('carts')->insert([
            [
                'user_id' => 1, // giả sử user 1 có
                'product_id' => 1,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 3,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 2,
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 4,
                'quantity' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 6,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 5,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}