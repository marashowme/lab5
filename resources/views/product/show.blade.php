@extends('layouts.app')

@php
    $translation = $product->getTranslation();
@endphp

@section('title', $translation->name ?? '')

@section('content')
    <h1>{{ $translation->name ?? '' }}</h1>
    <p><strong>Ціна:</strong> {{ $product->price }} грн</p>
    <p><strong>Опис:</strong> {{ $translation->description ?? '' }}</p>
    <p><strong>Кількість:</strong> {{ $product->quantity }}</p>

    <div class="tags" style="margin-top: 15px;">
        <strong>Мітки: </strong>
        @forelse ($product->filters as $filter)
            <span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; margin-right: 5px;">
                {{ $filter->filter_name }}
            </span>
        @empty
            <span>Міток немає.</span>
        @endforelse
    </div>

    <p><a href="{{ route('product.edit', $product) }}">Редагувати</a></p>
    <form method="POST" action="{{ route('product.destroy', $product) }}">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Видалити?')">Видалити</button>
    </form>
    <br>
    <p><a href="{{ route('product.index') }}">Повернутися до списку</a></p>
@endsection
