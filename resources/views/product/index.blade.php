@extends('layouts.app')

@section('title', 'Каталог товарів')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Каталог комп'ютерної техніки</h1>
        <div>
            <strong>Мова / Language: </strong>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk', 'page' => null]) }}"
               class="btn" style="{{ $lang === 'uk' ? 'background:#0056b3;' : '' }}">UA</a>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'en', 'page' => null]) }}"
               class="btn" style="{{ $lang === 'en' ? 'background:#0056b3;' : '' }}">EN</a>
        </div>
    </div>

    <p><a href="{{ route('product.create') }}">Додати новий товар</a></p>

    <form method="GET" action="{{ route('product.index') }}">
        <input type="hidden" name="lang" value="{{ $lang }}">
        @if ($filterId)
            <input type="hidden" name="filter" value="{{ $filterId }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Пошук...">
        <button type="submit">Шукати</button>
    </form><br>

    <div class="product-filters" style="margin-bottom: 20px;">
        <a href="{{ request()->fullUrlWithQuery(['filter' => null, 'page' => null]) }}"
           style="margin-right: 10px; {{ $filterId ? '' : 'font-weight: bold;' }}">Усі товари</a>
        @foreach ($filters as $id => $name)
            <a href="{{ request()->fullUrlWithQuery(['filter' => $id, 'page' => null]) }}"
               style="margin-right: 10px; text-decoration: none; color: #2563eb;
                      {{ (string) $filterId === (string) $id ? 'font-weight: bold;' : '' }}">
                {{ $name }}
            </a>
        @endforeach
    </div>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Назва товару / Product Name</th>
            <th>Опис / Description</th>
            <th>Мітки</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($products as $i => $product)
            @php $trans = $product->getTranslation($lang); @endphp
            <tr>
                <td>{{ $products->firstItem() + $i }}</td>
                <td>
                    <a href="{{ route('product.show', $product) }}">
                        <strong>{{ $trans?->name ?? '—' }}</strong>
                    </a>
                </td>
                <td>{{ $trans?->description ?? '—' }}</td>
                <td>{{ $product->filters->pluck('filter_name')->join(', ') ?: '—' }}</td>
                <td>{{ $product->price }} грн</td>
                <td>{{ $product->quantity }}</td>
                <td><a href="{{ route('product.edit', $product) }}">Редагувати</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Товарів не знайдено.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <br>
    {{ $products->links() }}
@endsection
