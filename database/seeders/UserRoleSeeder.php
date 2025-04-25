<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    const MAX_RECORDS = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < self::MAX_RECORDS; $i++) {
            DB::table('user_role')->insert([
                [
                    'user_id' => $i,
                    'role_id' => rand(1, 3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
