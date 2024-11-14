<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemPesananSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch menu prices based on item names
        $menuPrices = DB::table('menus')->whereIn('name', [
            'Mie Hokkien', 'Sup Wonton', 'Ayam Kecap', 'Mie Pangsit', 'Tumis Taoge'
        ])->pluck('total_harga', 'name');

        // Prepare item data for item_pesanans
        $itemData = [
            ['pesanan_id' => 1, 'kuantitas' => 2, 'name' => 'Mie Hokkien', 'harga' => 70000],
            ['pesanan_id' => 2, 'kuantitas' => 1, 'name' => 'Sup Wonton', 'harga' => 250000],
            ['pesanan_id' => 3, 'kuantitas' => 3, 'name' => 'Ayam Kecap', 'harga' => 90000],
            ['pesanan_id' => 4, 'kuantitas' => 5, 'name' => 'Mie Pangsit', 'harga' => 125000],
            ['pesanan_id' => 5, 'kuantitas' => 4, 'name' => 'Tumis Taoge', 'harga' => 60000],
            ['pesanan_id' => 5, 'kuantitas' => 2, 'name' => 'Mie Pangsit', 'harga' => 50000],
        ];

        // Insert item data into item_pesanans table
        foreach ($itemData as $item) {
            DB::table('item_pesanans')->insert($item);
        }
    }
}

