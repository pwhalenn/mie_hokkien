<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            [
                'userID' => 'U001',
                'pesananID' => '0001',
                'status' => 'pembayaran berhasil',
                'transaksiID' => 'P001',
                'gross_amount' => 45.000,
                'metode' => 'CASH',
            ],

            [
                'userID' => 'U002',
                'pesananID' => '0002',
                'status' => 'pembayaran gagal',
                'transaksiID' => 'P002',
                'gross_amount' => 30.000,
                'metode' => 'QRIS',
            ],

            [
                'userID' => 'U003',
                'pesananID' => '0003',
                'status' => 'pembayaran berhasil',
                'transaksiID' => 'P003',
                'gross_amount' => 10.000,
                'metode' => 'CASH',
            ],

            [
                'userID' => 'U004',
                'pesananID' => '0004',
                'status' => 'pembayaran berhasil',
                'transaksiID' => 'P004',
                'gross_amount' => 100.000,
                'metode' => 'DEBIT',
            ],

            [
                'userID' => 'U005',
                'pesananID' => '0005',
                'status' => 'pembayaran gagal',
                'transaksiID' => 'P005',
                'gross_amount' => 150.000,
                'metode' => 'QRIS',
            ],

        ]);
    }
}
