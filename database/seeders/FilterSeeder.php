<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Ігрове',
            'Бездротове',
            'RGB підсвічування',
            'Механічне',
            '4K роздільна здатність',
            'Висока продуктивність',
        ];

        foreach ($names as $name) {
            Filter::firstOrCreate([
                'filter_name' => $name,
            ]);
        }
    }
}
