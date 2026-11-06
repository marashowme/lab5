@extends('layouts.app')

@section('title', 'Статистика відвідувань магазину')

@section('content')
    <div class="container">
        <h1>Статистика відвідувань інтернет-магазину</h1>
        <p class="mb-4">
            <a href="{{ route('stats.pages', ['type' => 'page']) }}" class="btn btn-sm {{ $type === 'page' ? 'btn-primary' : 'btn-outline-primary' }}">За сторінками / товарами</a>
            <a href="{{ route('stats.pages', ['type' => 'ip']) }}" class="btn btn-sm {{ $type === 'ip' ? 'btn-primary' : 'btn-outline-primary' }}">За ІР-адресами</a>
        </p>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>{{ $type === 'page' ? 'Сторінка / Товар' : 'IP-адреса' }}</th>
                <th>Звернень (Переглядів)</th>
                <th>Унікальних IP</th>
                <th>Останній візит</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td>
                        <a href="{{ route('stats.detail', ['type' => $type, 'item' => $row->{$type}]) }}">
                            {{ $row->{$type} }}
                        </a>
                    </td>
                    <td>{{ $row->hits }}</td>
                    <td>{{ $row->visitors ?? 1 }}</td>
                    <td>{{ $row->last_visit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Даних про відвідування ще немає.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
