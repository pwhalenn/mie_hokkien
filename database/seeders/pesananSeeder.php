<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Calculate total_harga for each pesanan_id
        $totals = DB::table('item_pesanans')
            ->whereIn('pesanan_id', [1, 2, 3, 4, 5])
            ->pluck('harga', 'name');

        // Prepare data to insert into pesanans
        $pesananData = [
            [
                'user_id' => 1,
                'total_harga' => $totals[1],
            ],
            [
                'user_id' => 2,
                'total_harga' => $totals[2],
            ],
            [
                'user_id' => 3,
                'total_harga' => $totals[3],
            ],
            [
                'user_id' => 4,
                'total_harga' => $totals[4],
            ],
            [
                'user_id' => 5,
                'total_harga' => $totals[5] + $totals[6],
            ],
        ];

        // Insert data into pesanans table
        DB::table('pesanans')->insert($pesananData);
    }
}