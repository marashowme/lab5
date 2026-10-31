@extends('layouts.app')
@section('title', 'Редагувати товар')
@section('content')
    <h1>Редагувати товар</h1>
    <form method="POST" action="{{ route('product.update', $product) }}">
        @csrf @method('PUT') @include('product._form')
        <button type="submit">Зберегти зміни</button>
    </form>
    <p><a href="{{ route('product.index') }}">Назад</a></p>
@endsection
