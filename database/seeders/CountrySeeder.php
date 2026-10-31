<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('country')->insert([
            ['code' => 'UA', 'name' => 'Ukraine', 'population' => 41167335],
            ['code' => 'US', 'name' => 'United States', 'population' => 323995528],
            ['code' => 'PL', 'name' => 'Poland', 'population' => 38000000],
        ]);
    }
}
