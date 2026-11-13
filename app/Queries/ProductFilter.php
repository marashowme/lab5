<?php

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    private const SORTABLE = [
        'price'        => 'products.price',
        'quantity'     => 'products.quantity',
        'categoryName' => 'category.category_name', // якщо є категорія товарів
        'created'      => 'products.created_at',
    ];

    public function apply(array $input): Builder
    {
        $query = Product::query()
            ->with(['translations', 'category', 'filters'])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id') // адаптуйте під назву вашої таблиці категорій, якщо потрібно
            ->select('products.*');

        // Пошук за назвою у перекладах (або за артикулом/іншим полем)
        $query->when(
            $input['search'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'translations',
                fn (Builder $trans) => $trans->where('name', 'like', "%{$value}%")
            )
        );

        // Фільтрація за конкретною категорією (з випадаючого списку)
        $query->when(
            $input['category_id'] ?? null,
            fn (Builder $q, $value) => $q->where('products.category_id', $value)
        );

        // Фільтрація за міткою (фільтром через зв'язок N:N)
        $query->when(
            $input['filter_id'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'filters',
                fn (Builder $related) => $related->whereKey($value)
            )
        );

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc = str_starts_with($sort ?? '', '-');
        $field = $desc ? substr($sort, 1) : $sort;

        if (!isset(self::SORTABLE[$field])) {
            return $query->orderByDesc('products.created_at')
                ->orderByDesc('products.id');
        }

        return $query
            ->orderBy(self::SORTABLE[$field], $desc ? 'desc' : 'asc')
            ->orderByDesc('products.id');
    }
}
