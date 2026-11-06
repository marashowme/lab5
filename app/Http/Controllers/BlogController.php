<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'uk');

        $blogs = Blog::with(['category', 'author', 'filters', 'translations' => function ($query) use ($lang) {
            // Обрана мова + українська як резервна
            $query->whereIn('locale', [$lang, 'uk']);
        }])->orderByDesc('dt_created')->paginate(6)->withQueryString();

        return view('blog.index', compact('blogs', 'lang'));
    }

    public function admin()
    {
        $blogs = Blog::with(['category', 'translations'])
            ->orderByDesc('dt_created')
            ->paginate(10);

        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');

        $filters = Filter::orderBy('filter_name')
            ->pluck('filter_name', 'filter_id');

        return view('blog.create', compact('categories', 'filters'));
    }

    public function store(BlogRequest $request)
    {
        $data = $request->validated();

        $blog = Blog::create([
            ...Arr::except($data, ['filters']),
            'user_id' => auth()->id(),
        ]);

        $blog->filters()->sync($data['filters'] ?? []);

        return redirect()->route('blog.show', $blog);
    }

    public function show(Request $request, Blog $blog)
    {
        $lang = $request->query('lang', 'uk');

        $blog->load(['category', 'author', 'translations', 'filters']);

        return view('blog.show', compact('blog', 'lang'));
    }

    public function edit(Blog $blog)
    {
        $blog->load('filters');

        $categories = Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');

        $filters = Filter::orderBy('filter_name')
            ->pluck('filter_name', 'filter_id');

        $selected = $blog->filters->pluck('filter_id')->all();

        return view('blog.edit', compact('blog', 'categories', 'filters', 'selected'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        $blog->update(Arr::except($data, ['filters']));
        $blog->filters()->sync($data['filters'] ?? []);

        return redirect()->route('blog.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin');
    }
}
