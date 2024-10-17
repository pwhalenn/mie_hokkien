<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $userIDs = DB::table('users')->pluck('userID');

        DB::table('pesanans')->insert([
            [
            'userID' => 1,
            'total_harga' => 45000,
            ],
            [
            'userID' => 2,
            'total_harga' => 30000,
            ],
            [
            'userID' => 3,
            'total_harga' => 10000,
            ],
            [
            'userID' => 4,
            'total_harga' => 100000,
            ],
            [
            'userID' => 5,
            'total_harga' => 150000,
            ],
        ]);
    }
}
