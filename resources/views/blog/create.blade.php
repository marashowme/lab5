@extends('layouts.app')
@section('title', 'Створити запис')
@section('content')
    <div class="container" style="max-width:700px;">
        <h1>Створити запис у блозі</h1>
        <form method="POST" action="{{ route('blog.store') }}">
            @csrf
            @include('blog._form')
            <button type="submit">Зберегти</button>
            <a href="{{ route('blog.admin') }}" style="margin-left:10px; text-decoration:none;">Скасувати</a>
        </form>
    </div>
@endsection
