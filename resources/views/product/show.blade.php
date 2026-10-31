@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <h1>{{ $product->name }}</h1>
    <p><strong>Ціна:</strong> {{ $product->price }} грн</p>
    <p><strong>Опис:</strong> {{ $product->description }}</p>
    <p><strong>Кількість:</strong> {{ $product->quantity }}</p>
    <p><a href="{{ route('product.edit', $product) }}">Редагувати</a></p>
    <form method="POST" action="{{ route('product.destroy', $product) }}">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Видалити?')">Видалити</button>
    </form>
    <br>
    <p><a href="{{ route('product.index') }}">Повернутися до списку</a></p>
@endsection
