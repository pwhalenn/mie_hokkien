<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuPrices = DB::table('menus')->whereIn('name', [
            'Mie Hokkien', 'Sup Wonton', 'Ayam Kecap', 'Mie Pangsit', 'Tumis Taoge'
        ])->pluck('total_harga', 'name');

        DB::table('item_pesanans')->insert([
            [
                'pesanan_id' => 1,
                'kuantitas' => 2,
                'name' => 'Mie Hokkien',
                'harga' => $menuPrices['Mie Hokkien'] * 2,
            ],
            [
                'pesanan_id' => 2,
                'kuantitas' => 1,
                'name' => 'Sup Wonton',
                'harga' => $menuPrices['Sup Wonton'] * 1,
            ],
            [
                'pesanan_id' => 3,
                'kuantitas' => 3,
                'name' => 'Ayam Kecap',
                'harga' => $menuPrices['Ayam Kecap'] * 3,
            ],
            [
                'pesanan_id' => 4,
                'kuantitas' => 5,
                'name' => 'Mie Pangsit',
                'harga' => $menuPrices['Mie Pangsit'] * 5,
            ],
            [
                'pesanan_id' => 5,
                'kuantitas' => 4,
                'name' => 'Tumis Taoge',
                'harga' => $menuPrices['Tumis Taoge'] * 4,
            ],
            [
                'pesanan_id' => 5,
                'kuantitas' => 2,
                'name' => 'Mie Pangsit',
                'harga' => $menuPrices['Mie Pangsit'] * 2,
            ],
        ]);
    }
}
