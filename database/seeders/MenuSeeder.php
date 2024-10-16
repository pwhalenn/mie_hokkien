<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        DB::table('menus')->insert([
            [
                'name' => 'Mie Hokkien',
                'deskripsi' => 'Sebuah mahakarya orang hokkien dengan mie yang sangat enak.',
                'total_harga' => 35000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sup Wonton',
                'deskripsi' => 'Sup isi Wonton daging dengan campuran udang.',
                'total_harga' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayam Kecap',
                'deskripsi' => 'Ayam Kecap dengan Ayam Hainan.',
                'total_harga' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Pangsit',
                'deskripsi' => 'Sama aja bedanya pake Mie Pangsit.',
                'total_harga' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tumis Taoge',
                'deskripsi' => 'Taoge ditumis dengan saos tiram.',
                'total_harga' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
