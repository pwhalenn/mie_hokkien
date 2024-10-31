<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Destroyer', 'email' => 'des@gmail.com', 'password' => bcrypt('des')],
            ['name' => 'Farenheit', 'email' => 'far@gmail.com', 'password' => bcrypt('far')],
            ['name' => 'Json', 'email' => 'jsn@gmail.com', 'password' => bcrypt('jsn')],
            ['name' => 'Vickaroo', 'email' => 'vik@gmail.com', 'password' => bcrypt('vik')],
            ['name' => 'Vermilion', 'email' => 'ver@gmail.com', 'password' => bcrypt('ver')],
        ]);
    }
}

