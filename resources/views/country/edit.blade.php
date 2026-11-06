@extends('layouts.app')
@section('title', 'Редагувати країну')
@section('content')
    <h1>Редагувати країну</h1>
    <form method="POST" action="{{ route('country.update', $country) }}">
        @csrf
        @method('PUT')
        @include('country._form')
        <button type="submit">Зберегти зміни</button>
    </form>
    <p><a href="{{ route('country.index') }}">Назад</a></p>
@endsection
