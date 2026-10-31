<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'uk');

        $query = Product::with(['translations' => function ($q) use ($lang) {
            // Завантажуємо обрану мову та українську як резервну
            $q->whereIn('locale', [$lang, 'uk']);
        }]);

        // Пошук по назві в перекладах
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('translations', function ($q) use ($search, $lang) {
                $q->whereIn('locale', [$lang, 'uk'])
                    ->where('name', 'like', '%' . $search . '%');
            });
        }

        // Сортування за назвою у вибраній мові (з fallback на uk)
        $query->orderBy(
            \App\Models\ProductTranslation::select('name')
                ->whereColumn('product_translations.product_id', 'products.id')
                ->whereIn('locale', [$lang, 'uk'])
                ->orderByRaw("locale = ? DESC", [$lang])
                ->limit(1)
        );

        $products = $query->paginate(10)->withQueryString();

        return view('product.index', compact('products', 'lang'));
    }

    public function create()
    {
        return view('product.create');
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

        return redirect()->route('product.index');
    }

    public function show(Product $product)
    {
        $product->load('translations');

        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('translations');

        return view('product.edit', compact('product'));
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

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
