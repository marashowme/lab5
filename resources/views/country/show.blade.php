@extends('layouts.app')
@section('title', $country->name)
@section('content')
    <h1>{{ $country->name }}</h1>
    <p><strong>Код:</strong> {{ $country->code }}</p>
    <p><strong>Населення:</strong> {{ number_format($country->population, 0, ',', ' ') }}</p>
    <p><a href="{{ route('country.edit', $country) }}">Редагувати</a></p>
    <form method="POST" action="{{ route('country.destroy', $country) }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Видалити?')">Видалити</button>
    </form>
    <p><a href="{{ route('country.index') }}">Повернутися до списку</a></p>
@endsection
