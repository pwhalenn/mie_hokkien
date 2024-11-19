<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pesananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pesanans')->insert([
            ['pesanan_id' => 1, 'user_id' => 1, 'total_harga' => 70000],
            ['pesanan_id' => 2, 'user_id' => 2, 'total_harga' => 25000],
            ['pesanan_id' => 3, 'user_id' => 3, 'total_harga' => 90000],
            ['pesanan_id' => 4, 'user_id' => 4, 'total_harga' => 125000],
            ['pesanan_id' => 5, 'user_id' => 5, 'total_harga' => 110000],
        ]);
    }
}