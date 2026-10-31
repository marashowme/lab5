@extends('layouts.app')

@section('title', 'Блог магазину')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
        <h1>Блог комп'ютерної техніки</h1>
        <div>
            <strong>Мова: </strong>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk', 'page' => null]) }}" class="btn" style="background: {{ $lang === 'uk' ? '#2563eb' : '#9ca3af' }}">UA</a>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'en', 'page' => null]) }}" class="btn" style="background: {{ $lang === 'en' ? '#2563eb' : '#9ca3af' }}">EN</a>
            <a href="{{ route('blog.admin') }}" class="btn" style="margin-left: 15px;">Адміністрування</a>
        </div>
    </div>

    <div class="blog-grid">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog, 'lang' => $lang])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>

    <div style="margin-top:20px;">
        {{ $blogs->links() }}
    </div>
@endsection
