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
        
        //Truncate table
         DB::table('users')->truncate();
        //Insert data
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'phone' => '0123456789',
                'address' => 'thu duc',
                'gioitinh' => 'Nam',
                'ngaysinh' => '1990-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        for ($i = 2; $i < self::MAX_RECORDS; $i++) {
            DB::table('users')->insert([
                [
                    'name' => 'user' . $i,
                    'email' => "admin{$i}@gmail.com",
                    'email_verified_at' => now(),
                    'password' => Hash::make('123456'),
                    'remember_token' => Str::random(10),
                    'phone' => '09' . rand(10000000, 99999999),
                    'address' => 'ho chi minh',
                    'gioitinh' => rand(0, 1) ? 'Nam' : 'Nữ',
                    'ngaysinh' => now()->subYears(rand(18, 40))->subDays(rand(0, 365))->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
