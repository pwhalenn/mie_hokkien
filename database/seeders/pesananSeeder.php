<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesanans')->insert([
            [
            'user_id' => 1,
            'total_harga' => 45000,
            ],
            [
            'user_id' => 2,
            'total_harga' => 30000,
            ],
            [
            'user_id' => 3,
            'total_harga' => 10000,
            ],
            [
            'user_id' => 4,
            'total_harga' => 100000,
            ],
            [
            'user_id' => 5,
            'total_harga' => 150000,
            ],
        ]);
    }
}
