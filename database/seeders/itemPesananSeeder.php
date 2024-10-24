<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_pesanans')->insert([
            [
                'pesanan_id' => 1,
                'kuantitas' => 2,
                'name' => 'Item A',
                'harga' => 15000.00,
            ],
            [
                'pesanan_id' => 1,
                'kuantitas' => 1,
                'name' => 'Item B',
                'harga' => 30000.00,
            ],
            [
                'pesanan_id' => 2,
                'kuantitas' => 3,
                'name' => 'Item C',
                'harga' => 10000.00,
            ],
            [
                'pesanan_id' => 3,
                'kuantitas' => 5,
                'name' => 'Item D',
                'harga' => 20000.00,
            ],
            [
                'pesanan_id' => 4,
                'kuantitas' => 4,
                'name' => 'Item E',
                'harga' => 25000.00,
            ],
            [
                'pesanan_id' => 5,
                'kuantitas' => 2,
                'name' => 'Item F',
                'harga' => 70000.00,
            ],
        ]);
    }
}