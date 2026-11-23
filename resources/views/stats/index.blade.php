@extends('layouts.app')

@section('title', 'Статистика магазину')

@section('content')
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 20px;">
        <h1 style="margin-bottom: 20px;">Статистика відвідувань</h1>

        @php
            $totalVisits = \Illuminate\Support\Facades\DB::table('tracker')->count();
            $uniqueIps = \Illuminate\Support\Facades\DB::table('tracker')->distinct('ip')->count('ip');
            $lastVisit = \Illuminate\Support\Facades\DB::table('tracker')->max('visited_at');
        @endphp

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                <div style="color: #64748b; font-size: 0.9rem;">Усього переходів</div>
                <div style="font-size: 1.6rem; font-weight: 700; margin-top: 6px;">{{ $totalVisits }}</div>
            </div>

            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                <div style="color: #64748b; font-size: 0.9rem;">Унікальних IP-адрес</div>
                <div style="font-size: 1.6rem; font-weight: 700; margin-top: 6px;">{{ $uniqueIps }}</div>
            </div>

            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                <div style="color: #64748b; font-size: 0.9rem;">Останній візит</div>
                <div style="font-size: 1.1rem; font-weight: 600; margin-top: 10px;">{{ $lastVisit ?? '—' }}</div>
            </div>
        </div>

        <a href="{{ route('product.index') }}" style="color: #005663; text-decoration: none;">← Повернутися до каталогу товарів</a>
    </div>
@endsection
