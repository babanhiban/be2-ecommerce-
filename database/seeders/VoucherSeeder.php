<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Illuminate\Support\Str;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Voucher::create([
                'code' => strtoupper(Str::random(6)),
                'discount' => rand(5, 50),
                'start_date' => now()->subDays(rand(0, 15))->format('Y-m-d'),
                'end_date' => now()->addDays(rand(5, 30))->format('Y-m-d'),
            ]);
        }
    }
}
