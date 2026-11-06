<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Ноутбук Lenovo Legion 5', 'price' => 45999.00, 'description' => 'Ігровий ноутбук', 'quantity' => 5],
            ['name' => 'Миша Logitech G Pro Wireless', 'price' => 4500.00, 'description' => 'Бездротова миша', 'quantity' => 15],
            ['name' => 'Клавіатура Logitech G Pro TKL', 'price' => 3999.00, 'description' => 'Механічна клавіатура', 'quantity' => 10],
            ['name' => 'Монітор 27 Dell UltraSharp', 'price' => 18500.00, 'description' => 'IPS монітор', 'quantity' => 7],
        ]);
    }
}
