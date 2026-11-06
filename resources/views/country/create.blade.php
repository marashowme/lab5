@extends('layouts.app')
@section('title', 'Додати країну')
@section('content')
    <h1>Додати країну</h1>
    <form method="POST" action="{{ route('country.store') }}">
        @csrf
        @include('country._form')
        <button type="submit">Зберегти</button>
    </form>
    <p><a href="{{ route('country.index') }}">Назад</a></p>
@endsection
