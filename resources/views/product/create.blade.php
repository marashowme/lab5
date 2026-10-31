@extends('layouts.app')
@section('title', 'Додати товар')
@section('content')
    <h1>Додати новий товар</h1>
    <form method="POST" action="{{ route('product.store') }}">
        @csrf @include('product._form')
        <button type="submit">Зберегти</button>
    </form>
    <p><a href="{{ route('product.index') }}">Назад</a></p>
@endsection
