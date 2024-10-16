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
        $faker = Faker::create('id_ID');
        $userIDs = DB::table('users')->pluck('userID');

        DB::table('pesanans')->insert([
            [
            'userID' => 1,
            'total_harga' => 50000,
            ],
            [
            'userID' => 2,
            'total_harga' => 45000,
            ],
            [
            'userID' => 3,
            'total_harga' => 60000,
            ],
            [
            'userID' => 4,
            'total_harga' => 65000,
            ],
            [
            'userID' => 3,
            'total_harga' => 80000,
            ],
        ]);
    }
}
