@php $trans = $blog->getTranslation($lang ?? 'uk'); @endphp
<article class="blog-card">
    <a href="{{ route('blog.show', ['blog' => $blog, 'lang' => $lang ?? 'uk']) }}">
        <img src="{{ asset('images/blog-placeholder.jpg') }}" alt="{{ $trans?->title ?? $blog->title }}" class="blog-card-image">
    </a>
    <div class="blog-card-body">
        <span class="blog-category">{{ $blog->category?->category_name ?? 'Без категорії' }}</span>
        <h2 style="margin: 8px 0; font-size: 1.2rem;">
            <a href="{{ route('blog.show', ['blog' => $blog, 'lang' => $lang ?? 'uk']) }}" style="text-decoration:none; color:#111827;">{{ $trans?->title ?? $blog->title }}</a>
        </h2>
        <p class="blog-meta">
            Автор: {{ $blog->author?->name ?? 'Редакція' }} &middot; {{ $blog->dt_created->format('d.m.Y') }}
        </p>
        <p style="color: #4b5563; font-size: 0.95rem;">
            {{ \Illuminate\Support\Str::limit($trans?->description ?? $blog->description, 120) }}
        </p>
        <a href="{{ route('blog.show', ['blog' => $blog, 'lang' => $lang ?? 'uk']) }}" style="color:#2563eb; text-decoration:none; font-weight:bold;">Читати далі &rarr;</a>
    </div>
</article>
