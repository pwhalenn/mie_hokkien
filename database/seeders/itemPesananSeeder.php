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

        // Insert pesanan records first
        $pesananData = [
            ['user_id' => 1, 'total_harga' => 0], // Adjust this as needed
            ['user_id' => 2, 'total_harga' => 0],
            ['user_id' => 3, 'total_harga' => 0],
            ['user_id' => 4, 'total_harga' => 0],
            ['user_id' => 5, 'total_harga' => 0],
        ];

        // Insert into pesanan table and get the generated IDs
        $pesananIds = DB::table('pesanans')->insertGetId($pesananData);

        // Prepare item data for item_pesanans
        $itemData = [
            ['pesanan_id' => $pesananIds[0], 'kuantitas' => 2, 'name' => 'Mie Hokkien', 'harga' => $menuPrices['Mie Hokkien'] * 2],
            ['pesanan_id' => $pesananIds[1], 'kuantitas' => 1, 'name' => 'Sup Wonton', 'harga' => $menuPrices['Sup Wonton'] * 1],
            ['pesanan_id' => $pesananIds[2], 'kuantitas' => 3, 'name' => 'Ayam Kecap', 'harga' => $menuPrices['Ayam Kecap'] * 3],
            ['pesanan_id' => $pesananIds[3], 'kuantitas' => 5, 'name' => 'Mie Pangsit', 'harga' => $menuPrices['Mie Pangsit'] * 5],
            ['pesanan_id' => $pesananIds[4], 'kuantitas' => 4, 'name' => 'Tumis Taoge', 'harga' => $menuPrices['Tumis Taoge'] * 4],
            ['pesanan_id' => $pesananIds[4], 'kuantitas' => 2, 'name' => 'Mie Pangsit', 'harga' => $menuPrices['Mie Pangsit'] * 2],
        ];

        // Insert item data into item_pesanans table
        foreach ($itemData as $item) {
            DB::table('item_pesanans')->insert($item);
        }
    }
}

