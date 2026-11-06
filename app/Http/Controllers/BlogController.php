<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'uk');

        $blogs = Blog::with(['category', 'author', 'translations' => function ($query) use ($lang) {
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

        return view('blog.create', compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('blog.show', $blog);
    }

    public function show(Request $request, Blog $blog)
    {
        $lang = $request->query('lang', 'uk');

        $blog->load(['category', 'author', 'translations']);

        return view('blog.show', compact('blog', 'lang'));
    }

    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');

        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return redirect()->route('blog.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin');
    }
}
