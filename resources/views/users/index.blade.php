@extends('layouts.app')

@section('title', 'Користувачі системи')

@section('content')
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h1>Користувачі системи (Магазин комп'ютерної техніки)</h1>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; background:#fff;">
                <thead>
                <tr style="background:#f1f5f9; text-align:left;">
                    <th style="padding:10px; border-bottom:2px solid #cbd5e1; width:60px;">#</th>
                    <th style="padding:10px; border-bottom:2px solid #cbd5e1;">Ім’я</th>
                    <th style="padding:10px; border-bottom:2px solid #cbd5e1;">Електронна пошта</th>
                    <th style="padding:10px; border-bottom:2px solid #cbd5e1;">Дата реєстрації</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $i => $user)
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:10px;">{{ $users->firstItem() + $i }}</td>
                        <td style="padding:10px; font-weight:600;">{{ $user->name }}</td>
                        <td style="padding:10px;">{{ $user->email }}</td>
                        <td style="padding:10px;">{{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:16px; text-align:center; color:#64748b;">Користувачів поки немає.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $users->links() }}
        </div>
    </div>
@endsection
