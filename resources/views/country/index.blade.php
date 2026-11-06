@extends('layouts.app')

@section('title', 'Довідник країн')

@section('content')
    <h1>Довідник країн (Лабораторна робота)</h1>

    <p>
        <a href="{{ route('country.create') }}" class="btn">Додати країну</a>
    </p>

    <table>
        <thead>
        <tr>
            <th>Код</th>
            <th>Назва</th>
            <th>Населення</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->code }}</td>
                <td>
                    <a href="{{ route('country.show', $country) }}">{{ $country->name }}</a>
                </td>
                <td>{{ number_format($country->population, 0, ',', ' ') }}</td>
                <td>
                    <a href="{{ route('country.edit', $country) }}" class="btn" style="background: #ffc107; color: black; padding: 4px 8px; font-size: 0.9em;">Редагувати</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>
    {{ $countries->links() }}
@endsection
