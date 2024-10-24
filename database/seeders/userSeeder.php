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
            ['name' => 'Destroyer', 'email' => 'des@example.com', 'password' => bcrypt('des')],
            ['name' => 'Farenheit', 'email' => 'far@example.com', 'password' => bcrypt('far')],
            ['name' => 'Json', 'email' => 'jsn@example.com', 'password' => bcrypt('jsn')],
            ['name' => 'Vickaroo', 'email' => 'vik@example.com', 'password' => bcrypt('vik')],
            ['name' => 'Vermilion', 'email' => 'ver@example.com', 'password' => bcrypt('ver')],
        ]);
    }
}

