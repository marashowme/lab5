<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'filter' => ['nullable', 'integer', 'exists:filter,filter_id'],
        ]);

        $lang     = $request->query('lang', 'uk');
        $filterId = $request->query('filter');

        $query = Product::with([
            'translations' => function ($q) use ($lang) {
                $q->whereIn('locale', [$lang, 'uk']);
            },
            'filters',
        ]);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('translations', function ($q) use ($search, $lang) {
                $q->whereIn('locale', [$lang, 'uk'])
                    ->where('name', 'like', '%' . $search . '%');
            });
        }

        $query->when($filterId, function ($q) use ($filterId) {
            $q->whereHas('filters', function ($f) use ($filterId) {
                $f->where('filter.filter_id', $filterId);
            });
        });

        $query->orderBy(
            ProductTranslation::select('name')
                ->whereColumn('product_translations.product_id', 'products.id')
                ->whereIn('locale', [$lang, 'uk'])
                ->orderByRaw('locale = ? DESC', [$lang])
                ->limit(1)
        );

        $products = $query->paginate(10)->withQueryString();
        $filters  = Filter::pluck('filter_name', 'filter_id');

        return view('product.index', compact('products', 'lang', 'filters', 'filterId'));
    }

    public function create()
    {
        $filters = Filter::pluck('filter_name', 'filter_id');

        return view('product.create', compact('filters'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'price'    => $data['price'],
            'quantity' => $data['quantity'],
        ]);

        $product->translations()->create([
            'locale'      => 'uk',
            'name'        => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        $product->filters()->sync($data['filters'] ?? []);

        return redirect()->route('product.index');
    }

    public function show(Product $product)
    {
        $product->load(['translations', 'filters']);

        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['translations', 'filters']);

        $filters  = Filter::pluck('filter_name', 'filter_id');
        $selected = $product->filters->pluck('filter_id')->all();

        return view('product.edit', compact('product', 'filters', 'selected'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->update([
            'price'    => $data['price'],
            'quantity' => $data['quantity'],
        ]);

        $product->translations()->updateOrCreate(
            ['locale' => 'uk'],
            [
                'name'        => $data['name'],
                'description' => $data['description'] ?? null,
            ]
        );

        $product->filters()->sync($data['filters'] ?? []);

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
