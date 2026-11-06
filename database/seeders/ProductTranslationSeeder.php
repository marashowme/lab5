<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $productsData = [
            [
                'price' => 3900,
                'quantity' => 10,
                'uk' => ['name' => "Клавіатура Logitech G Pro TKL", 'description' => "Механічна ігрова клавіатура з підсвічуванням RGB."],
                'en' => ['name' => "Logitech G Pro TKL Keyboard", 'description' => "Mechanical gaming keyboard with RGB backlighting."]
            ],
            [
                'price' => 1000,
                'quantity' => 100,
                'uk' => ['name' => "Ігровий килимок для миші", 'description' => "Великий поверхневий килимок з тканинним покриттям."],
                'en' => ['name' => "Gaming Mouse Pad", 'description' => "Large surface mouse pad with cloth texture."]
            ],
            [
                'price' => 4500,
                'quantity' => 15,
                'uk' => ['name' => "Миша Logitech G Pro Wireless", 'description' => "Бездротова ігрова миша з точним оптичним сенсором."],
                'en' => ['name' => "Logitech G Pro Wireless Mouse", 'description' => "Wireless gaming mouse with high-precision optical sensor."]
            ],
            [
                'price' => 18500,
                'quantity' => 7,
                'uk' => ['name' => "Монітор 27 Dell UltraSharp", 'description' => "Професійний 4K IPS монітор з точним відтворенням кольорів."],
                'en' => ['name' => "27 Dell UltraSharp Monitor", 'description' => "Professional 4K IPS monitor with accurate color reproduction."]
            ],
            [
                'price' => 45000,
                'quantity' => 5,
                'uk' => ['name' => "Ноутбук Lenovo Legion 5", 'description' => "Потужний ігровий ноутбук з процесором Ryzen 7 та RTX 4060."],
                'en' => ['name' => "Lenovo Legion 5 Laptop", 'description' => "Powerful gaming laptop with Ryzen 7 processor and RTX 4060."]
            ],
            [
                'price' => 8500,
                'quantity' => 12,
                'uk' => ['name' => "Материнська плата ASUS ROG Strix", 'description' => "Материнська плата для геймерських збірок останнього покоління."],
                'en' => ['name' => "ASUS ROG Strix Motherboard", 'description' => "Motherboard for modern gaming desktop builds."]
            ],
            [
                'price' => 12000,
                'quantity' => 8,
                'uk' => ['name' => "Відеокарта RTX 4060 8GB", 'description' => "Сучасна відеокарта з підтримкою трасування променів та DLSS 3."],
                'en' => ['name' => "RTX 4060 8GB Graphics Card", 'description' => "Modern graphics card supporting Ray Tracing and DLSS 3."]
            ],
        ];

        // Очищаємо таблиці, щоб повторний запуск не створював дублів.
        // Без вимкнення FK у MySQL truncate() впаде з помилкою
        // "Cannot truncate a table referenced in a foreign key constraint".
        Schema::disableForeignKeyConstraints();
        ProductTranslation::truncate();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($productsData as $data) {
            $product = Product::create([
                'price' => $data['price'],
                'quantity' => $data['quantity'],
            ]);

            ProductTranslation::create([
                'product_id' => $product->id,
                'locale' => 'uk',
                'name' => $data['uk']['name'],
                'description' => $data['uk']['description'],
            ]);

            ProductTranslation::create([
                'product_id' => $product->id,
                'locale' => 'en',
                'name' => $data['en']['name'],
                'description' => $data['en']['description'],
            ]);
        }
    }
}
