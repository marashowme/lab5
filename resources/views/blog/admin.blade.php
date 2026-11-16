@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h1>Адміністрування блогу</h1>
            <a href="{{ route('blog.create') }}" class="btn">Додати новий запис</a>
        </div>

        {{-- Форма пошуку, фільтрації та сортування (Case3) --}}
        <form method="GET" action="{{ route('blog.admin') }}" style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
            <div>
                <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Заголовок</label>
                <input type="text" id="title" name="title" value="{{ request('title') }}" placeholder="Пошук за заголовком" style="padding: 8px; width: 180px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <label for="categoryName" style="display: block; font-weight: bold; margin-bottom: 5px;">Назва категорії</label>
                <input type="text" id="categoryName" name="categoryName" value="{{ request('categoryName') }}" placeholder="Назва категорії" style="padding: 8px; width: 160px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <label for="category_id" style="display: block; font-weight: bold; margin-bottom: 5px;">Категорія</label>
                <select id="category_id" name="category_id" onchange="this.form.submit()" style="padding: 8px; width: 160px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Усі категорії</option>
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}" @selected(request('category_id') == $id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter_id" style="display: block; font-weight: bold; margin-bottom: 5px;">Мітка</label>
                <select id="filter_id" name="filter_id" style="padding: 8px; width: 160px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Усі мітки</option>
                    @foreach ($filters as $id => $name)
                        <option value="{{ $id }}" @selected(request('filter_id') == $id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Приховане поле для збереження сортування --}}
            <input type="hidden" name="sort" value="{{ request('sort') }}">

            <div>
                <button type="submit" class="btn" style="padding: 8px 15px; background: #005663; color: white; border: none; border-radius: 4px; cursor: pointer;">Знайти</button>
                <a href="{{ route('blog.admin') }}" style="margin-left: 10px; text-decoration: none; color: #555;">Скинути</a>
            </div>
        </form>

        {{-- Таблиця записів блогу --}}
        <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <thead>
            <tr style="background: #e9ecef; text-align: left;">
                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">#</th>

                {{-- Сортування за заголовком (title) --}}
                @php
                    $currentSort = request('sort');
                    $nextTitleSort = $currentSort === 'title' ? '-title' : 'title';
                @endphp
                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $nextTitleSort])) }}" style="text-decoration: none; color: #333;">
                        Заголовок
                        @if ($currentSort === 'title') ↑ @elseif ($currentSort === '-title') ↓ @endif
                    </a>
                </th>

                {{-- Сортування за категорією (categoryName) --}}
                @php
                    $nextCatSort = $currentSort === 'categoryName' ? '-categoryName' : 'categoryName';
                @endphp
                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $nextCatSort])) }}" style="text-decoration: none; color: #333;">
                        Категорія
                        @if ($currentSort === 'categoryName') ↑ @elseif ($currentSort === '-categoryName') ↓ @endif
                    </a>
                </th>

                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Мітки</th>

                {{-- Сортування за датою створення (created) --}}
                @php
                    $nextCreatedSort = $currentSort === 'created' ? '-created' : 'created';
                @endphp
                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $nextCreatedSort])) }}" style="text-decoration: none; color: #333;">
                        Дата створення
                        @if ($currentSort === 'created') ↑ @elseif ($currentSort === '-created') ↓ @endif
                    </a>
                </th>

                <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Дії</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($blogs as $i => $blog)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px;">{{ $blogs->firstItem() + $i }}</td>
                    <td style="padding: 12px;">
                        <a href="{{ route('blog.show', $blog) }}" style="color: #005663; text-decoration: none;">{{ $blog->title }}</a>
                    </td>
                    <td style="padding: 12px;">{{ $blog->category?->category_name ?? '—' }}</td>
                    <td style="padding: 12px;">
                        @forelse ($blog->filters as $filter)
                            <span style="background: #e2e8f0; padding: 3px 6px; border-radius: 4px; font-size: 0.85em; display: inline-block; margin-bottom: 2px;">
                                {{ $filter->filter_name }}
                            </span>
                        @empty
                            <span style="color: #999;">—</span>
                        @endforelse
                    </td>
                    <td style="padding: 12px;">{{ $blog->dt_created ? $blog->dt_created->format('d.m.Y H:i') : '—' }}</td>
                    <td style="padding: 12px; display:flex; gap:10px; align-items: center;">
                        <a href="{{ route('blog.edit', $blog) }}" class="btn" style="background:#f59e0b; color:white; padding: 5px 10px; border-radius: 4px; text-decoration:none; font-size: 0.9em;">Редагувати</a>
                        <form method="POST" action="{{ route('blog.destroy', $blog) }}" onsubmit="return confirm('Видалити запис?')" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#ef4444; color:white; border:none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 0.9em;">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #666;">Записів немає.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Пагінація зі збереженням параметрів пошуку та сортування --}}
        <div style="margin-top:20px;">
            {{ $blogs->withQueryString()->links() }}
        </div>
    </div>
@endsection
