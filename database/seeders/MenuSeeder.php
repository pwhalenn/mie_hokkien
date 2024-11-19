<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class menuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        DB::table('menus')->insert([ // untuk lihat menu aja
            [
                'menu_id' => 1, 
                'name' => 'Mie Hokkien',
                'deskripsi' => 'Sebuah mahakarya orang hokkien dengan mie yang sangat enak.',
                'total_harga' => 35000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 2, 
                'name' => 'Sup Wonton',
                'deskripsi' => 'Sup isi Wonton daging dengan campuran udang.',
                'total_harga' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 3, 
                'name' => 'Ayam Kecap',
                'deskripsi' => 'Ayam Kecap dengan Ayam Hainan.',
                'total_harga' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 4, 
                'name' => 'Mie Pangsit',
                'deskripsi' => 'Sama aja bedanya pake Mie Pangsit.',
                'total_harga' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 5, 
                'name' => 'Tumis Taoge',
                'deskripsi' => 'Taoge ditumis dengan saos tiram.',
                'total_harga' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
