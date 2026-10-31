@extends('layouts.app')
@section('title', 'Редагування запису')
@section('content')
    <div class="container" style="max-width:700px;">
        <h1>Редагувати запис</h1>
        <form method="POST" action="{{ route('blog.update', $blog) }}">
            @csrf
            @method('PUT')
            @include('blog._form')
            <button type="submit">Оновити</button>
            <a href="{{ route('blog.admin') }}" style="margin-left:10px; text-decoration:none;">Скасувати</a>
        </form>
    </div>
@endsection
