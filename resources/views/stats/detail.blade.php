@extends('layouts.app')

@section('title', 'Детальна статистика звернень')

@section('content')
    <div class="container">
        <h1>Детальна статистика</h1>
        <p>
            Фільтр: <strong>{{ $type }}</strong> = <strong>{{ $item }}</strong>
        </p>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Сторінка</th>
                <th>IP-адреса</th>
                <th>User-Agent (Браузер / Пристрій)</th>
                <th>Статус</th>
                <th>Дата і час</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row->page }}</td>
                    <td>{{ $row->ip }}</td>
                    <td><small>{{ $row->user_agent }}</small></td>
                    <td><span class="badge bg-{{ $row->status == 200 ? 'success' : 'danger' }}">{{ $row->status }}</span></td>
                    <td>{{ $row->visited_at->format('d.m.Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $rows->links() }}

        <p class="mt-3">
            <a href="{{ route('stats.pages') }}" class="btn btn-secondary">Назад до зведеної статистики</a>
        </p>
    </div>
@endsection
