<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pesananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pesanans')->insert([
            ['user_id' => 1, 'total_harga' => 70000],
            ['user_id' => 2, 'total_harga' => 25000],
            ['user_id' => 3, 'total_harga' => 90000],
            ['user_id' => 4, 'total_harga' => 125000],
            ['user_id' => 5, 'total_harga' => 110000],
        ]);
    }
}