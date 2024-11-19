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
        $users = DB::table('users')->get();
        DB::table('reservasis')->insert([
            [
                'reservasi_id' => 1,
                'user_id' => 1,
                'name' => $users->where('id', 1)->first()->name,
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '2',
                'jumlah_pax' => '10',
                'status' => 'Reservasi Diterima',
            ],
            [
                'reservasi_id' => 2,
                'user_id' => 2,
                'name' => $users->where('id', 2)->first()->name,
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '1',
                'jumlah_pax' => '5',
                'status' => 'Reservasi Diterima',
            ],
            [
                'reservasi_id' => 3,
                'user_id' => 3,
                'name' => $users->where('id', 3)->first()->name,
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '3',
                'jumlah_pax' => '15',
                'status' => 'Reservasi Ditolak',
            ],
            [
                'reservasi_id' => 4,
                'user_id' => 4,
                'name' => $users->where('id', 4)->first()->name,
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '2',
                'jumlah_pax' => '12',
                'status' => 'Reservasi Diterima',
            ],
        ]);
    }
}