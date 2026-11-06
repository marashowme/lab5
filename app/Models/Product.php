<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['price', 'quantity'];

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(
            Filter::class,
            'product_filter',
            'product_id',
            'filter_id'
        );
    }

    // Хелпер для отримання назви/опису з урахуванням обраної мови та дефолтної (uk)
    public function getTranslation(?string $locale = null)
    {
        $locale = $locale ?? request()->query('lang', 'uk');

        $translation = $this->translations->firstWhere('locale', $locale);

        // Fallback: якщо немає обраною мовою, беремо українську 'uk' або першу наявну
        if (!$translation) {
            $translation = $this->translations->firstWhere('locale', 'uk') ?? $this->translations->first();
        }

        return $translation;
    }
}
