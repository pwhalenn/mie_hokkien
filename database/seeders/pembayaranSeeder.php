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
        $totalPrice = DB::table('pesanans')->whereIn('user_id', [
            1, 2, 3, 4, 5
        ])->pluck('total_harga', 'user_id');

        DB::table('pembayarans')->insert([ // membayar
            [
                'user_id' => 1,
                'pesanan_id' => 1,
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P001',
                'gross_amount' => $totalPrice[1],
                'metode' => 'Cash',
            ],

            [
                'user_id' => 2,
                'pesanan_id' => 2,
                'status' => 'pembayaran gagal',
                'transaksi_id' => 'P002',
                'gross_amount' => $totalPrice[2],
                'metode' => 'QRIS',
            ],

            [
                'user_id' => 3,
                'pesanan_id' => 3,
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P003',
                'gross_amount' => $totalPrice[3],
                'metode' => 'Cash',
            ],

            [
                'user_id' => 4,
                'pesanan_id' => 4,
                'status' => 'pembayaran berhasil',
                'transaksi_id' => 'P004',
                'gross_amount' => $totalPrice[4],
                'metode' => 'Debit',
            ],

            [
                'user_id' => 5,
                'pesanan_id' => 5,
                'status' => 'pembayaran gagal',
                'transaksi_id' => 'P005',
                'gross_amount' => $totalPrice[5],
                'metode' => 'QRIS',
            ],

        ]);

    }
}
