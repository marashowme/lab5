<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Магазин комп\'ютерної техніки')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-nav {
            background: #2b2b2b;
            margin: 8px;
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .top-nav .links {
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
        }
        .top-nav a {
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            font-size: 15px;
        }
        .top-nav a:hover { text-decoration: underline; }
        .top-nav .auth a { font-weight: 400; color: #e2e8f0; }
        .top-nav .auth { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
        .top-nav .logout-btn {
            background: #ef4444; color: #fff; border: none;
            padding: 6px 12px; border-radius: 4px; cursor: pointer;
        }
        .page-card {
            max-width: 1100px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            box-sizing: border-box;
            width: calc(100% - 32px);
        }
        .flash-success {
            margin-bottom: 16px; padding: 12px 16px;
            background: #dcfce7; color: #166534; border-radius: 6px;
        }
    </style>
</head>
<body class="antialiased">

<nav class="top-nav">
    <div class="links">
        <a href="{{ url('/') }}">Головна</a>
        <a href="{{ url('/countries') }}">🌎 Довідник країн (ЛР)</a>
        <a href="{{ route('product.index') }}">🖥️ Магазин техніки (Індивідуальне)</a>
        <a href="{{ route('blog.index') }}">📕 Блог</a>
        <a href="{{ url('/statistics') }}">📊 Статистика магазину</a>
    </div>

    <div class="auth">
        @auth
            <a href="{{ route('product.admin') }}">Товари (адмін)</a>
            <a href="{{ route('blog.admin') }}">Блог (адмін)</a>
            <a href="{{ route('users.index') }}">Користувачі</a>
            <a href="{{ route('profile.edit') }}">Мій профіль</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Вийти ({{ auth()->user()->name }})</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Увійти</a>
            <a href="{{ route('register') }}">Реєстрація</a>
        @endguest
    </div>
</nav>

<main style="flex:1;">
    <div class="page-card">
        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        {{-- Breeze: <x-slot name="header"> --}}
        @isset($header)
            <div style="margin-bottom:20px;">{{ $header }}</div>
        @endisset

        {{-- Breeze: <x-app-layout> --}}
        @isset($slot)
            {{ $slot }}
        @endisset

        {{-- Класичні сторінки: @extends('layouts.app') --}}
        @yield('content')
    </div>
</main>

</body>
</html>
