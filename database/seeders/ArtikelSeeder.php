<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        DB::table('artikels')->insert([
            [
                'judul' => 'Sejarah Mie Hokkien',
                'artikel' => 'Mie Hokkien berasal dari tradisi kuliner suku Hokkien di China. Hidangan ini dikenal dengan tekstur mie yang kenyal dan kuah yang kaya rasa. Sekarang, Mie Hokkien menjadi populer di berbagai negara di Asia, termasuk Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Manfaat Makan Sup Wonton',
                'artikel' => 'Sup Wonton adalah hidangan kaya protein yang dibuat dari pangsit isi daging, sering kali dengan campuran udang. Selain enak, sup ini juga bermanfaat untuk kesehatan karena kandungan proteinnya yang tinggi dan rendah lemak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Resep Tumis Taoge yang Sederhana',
                'artikel' => 'Tumis taoge adalah hidangan sehat dan mudah dibuat. Cukup dengan menumis taoge bersama bawang putih, bawang merah, dan sedikit saus tiram, Anda dapat menikmati makanan sehat yang kaya akan vitamin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tips Membuat Ayam Kecap Lezat',
                'artikel' => 'Ayam kecap adalah hidangan populer di Indonesia. Untuk membuat ayam kecap yang lezat, gunakan bahan-bahan segar seperti bawang putih, kecap manis, dan sedikit jahe. Sajikan dengan nasi putih hangat untuk pengalaman yang maksimal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
