<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\reservasi;
use Carbon\Carbon;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::factory()->create([
            [
                'userID' => '0001',
                'name' => 'Andi',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '2',
                'jumlah_pax' => '10',
                'status' => 'Reservasi Diterima',
            ],

            [
                'userID' => '0002',
                'name' => 'Susan',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '1',
                'jumlah_pax' => '5',
                'status' => 'Reservasi Diterima',
            ],

            [
                'userID' => '0003',
                'name' => 'Michael',
                'tanggal' => Carbon::now(),
                'waktu' => Carbon::now(),
                'meja' => '3',
                'jumlah_pax' => '15',
                'status' => 'Reservasi Ditolak',
            ],

            [
                'userID' => '0004',
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
