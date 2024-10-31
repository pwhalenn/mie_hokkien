<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class reservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservasis')->insert([ // reservasi
            [
                'user_id' => 1,
                'name' => 'Andi',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '2',
                'jumlah_pax' => '10',
                'status' => 'Reservasi Diterima',
            ],

            [
                'user_id' => 2,
                'name' => 'Susan',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '1',
                'jumlah_pax' => '5',
                'status' => 'Reservasi Diterima',
            ],

            [
                'user_id' => 3,
                'name' => 'Michael',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '3',
                'jumlah_pax' => '15',
                'status' => 'Reservasi Ditolak',
            ],

            [
                'user_id' => 4,
                'name' => 'Anna',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '2',
                'jumlah_pax' => '12',
                'status' => 'Reservasi Diterima',
            ],
        ]);
    }
}
