<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class pembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayarans')->insert([
            [
                'user_id' => 'U001',
                'pesanan_id' => '0001',
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P001',
                'gross_amount' => 45000,
                'metode' => 'Cash',
            ],

            [
                'user_id' => 'U002',
                'pesanan_id' => '0002',
                'status' => 'pembayaran gagal',
                'transaksi_id' => 'P002',
                'gross_amount' => 30000,
                'metode' => 'QRIS',
            ],

            [
                'user_id' => 'U003',
                'pesanan_id' => '0003',
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P003',
                'gross_amount' => 10000,
                'metode' => 'Cash',
            ],

            [
                'user_id' => 'U004',
                'pesanan_id' => '0004',
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P004',
                'gross_amount' => 100000,
                'metode' => 'Debit',
            ],

            [
                'user_id' => 'U005',
                'pesanan_id' => '0005',
                'status' => 'pembayaran gagal',
                'transaksi_id' => 'P005',
                'gross_amount' => 150000,
                'metode' => 'QRIS',
            ],

        ]);

    }
}
