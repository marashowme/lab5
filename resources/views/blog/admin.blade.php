@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h1>Адміністрування блогу</h1>
            <a href="{{ route('blog.create') }}" class="btn">Додати новий запис</a>
        </div>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Заголовок</th>
                <th>Категорія</th>
                <th>Дата створення</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($blogs as $i => $blog)
                <tr>
                    <td>{{ $blogs->firstItem() + $i }}</td>
                    <td>
                        <a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a>
                    </td>
                    <td>{{ $blog->category?->category_name ?? '—' }}</td>
                    <td>{{ $blog->dt_created->format('d.m.Y H:i') }}</td>
                    <td style="display:flex; gap:10px;">
                        <a href="{{ route('blog.edit', $blog) }}" class="btn" style="background:#f59e0b;">Редагувати</a>
                        <form method="POST" action="{{ route('blog.destroy', $blog) }}" onsubmit="return confirm('Видалити запис?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#ef4444;">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Записів немає.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
