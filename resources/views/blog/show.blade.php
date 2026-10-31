@extends('layouts.app')
@section('title', $blog->title)
@section('content')
    <div class="container" style="max-width:800px;">
        <p><a href="{{ route('blog.index') }}">&larr; Назад до блогу</a></p>
        <h1>{{ $blog->title }}</h1>
        <p style="color:#666;">
            Категорія: <strong>{{ $blog->category?->category_name ?? 'Без категорії' }}</strong> |
            Автор: <strong>{{ $blog->author?->name ?? 'Редакція' }}</strong> |
            Опубліковано: {{ $blog->dt_created->format('d.m.Y H:i') }}
        </p>
        <hr>
        <p style="font-weight:bold; font-size:1.1rem;">{{ $blog->description }}</p>
        <div style="line-height:1.6; margin-top:20px;">
            {!! nl2br(e($blog->text)) !!}
        </div>
    </div>
@endsection
