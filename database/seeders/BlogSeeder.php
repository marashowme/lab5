<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [];
        foreach (['Новини ПК', 'Огляди периферії', 'Поради покупцям'] as $name) {
            $categories[] = Category::firstOrCreate([
                'category_name' => $name,
                'category_info' => "Категорія статей про $name",
            ]);
        }

        // Очищаємо старі дані (FK вимикаємо, інакше truncate() впаде в MySQL)
        Schema::disableForeignKeyConstraints();
        BlogTranslation::truncate();
        Blog::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 1; $i <= 8; $i++) {
            $blog = Blog::create([
                // Українські значення лишаємо в самій таблиці blog,
                // щоб не залежати від того, чи nullable ці колонки
                'title'       => "Навчальний запис про комп'ютерну техніку №{$i}",
                'description' => "Короткий опис новини або огляду комплектуючих №{$i} українською.",
                'text'        => "Повний детальний текст публікації №{$i} про вибір та тестування сучасних ПК українською мовою.",
                'category_id' => $categories[($i - 1) % count($categories)]->category_id,
                'user_id'     => null,
            ]);

            BlogTranslation::create([
                'blog_id'     => $blog->blog_id,
                'locale'      => 'uk',
                'title'       => "Навчальний запис про комп'ютерну техніку №{$i}",
                'description' => "Короткий опис новини або огляду комплектуючих №{$i} українською.",
                'text'        => "Повний детальний текст публікації №{$i} про вибір та тестування сучасних ПК українською мовою.",
            ]);

            BlogTranslation::create([
                'blog_id'     => $blog->blog_id,
                'locale'      => 'en',
                'title'       => "Educational post about computer hardware №{$i}",
                'description' => "Short description of news or hardware review №{$i} in English.",
                'text'        => "Full detailed text of publication №{$i} about choosing and testing modern PCs in English.",
            ]);
        }
    }
}
