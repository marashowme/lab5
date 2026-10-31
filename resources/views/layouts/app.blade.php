<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мій сайт')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9; }
        nav { background: #333; padding: 12px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        button, .btn { padding: 6px 12px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; }
        button:hover, .btn:hover { background: #0056b3; }
        .error { color: red; font-size: 0.9em; }
        .mb-0 { margin-bottom: 0; }
        footer { margin-top: 20px; padding: 12px; color: #666; text-align: center; font-size: 0.9em; }

        /* Стилі блогу */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin: 24px 0;
        }
        .blog-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }
        .blog-card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .blog-card-body {
            padding: 16px;
        }
        .blog-category {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #2563eb;
        }
        .blog-meta {
            font-size: 13px;
            color: #6b7280;
            margin: 6px 0;
        }
    </style>
</head>
<body>

<!-- Єдине головне меню для всього сайту -->
<nav>
    <a href="/">Головна</a>
    <a href="{{ route('country.index') }}">🌍 Довідник країн (ЛР)</a>
    <a href="{{ route('product.index') }}">💻 Магазин техніки (Індивідуальне)</a>
    <a href="{{ route('blog.index') }}">📝 Блог</a>
    <a href="{{ route('stats.pages') }}">📊 Статистика магазину</a>
</nav>

<div class="container">
    <!-- Сюди буде підставлятися вміст кожної сторінки -->
    @yield('content')
</div>

<footer>
    <p class="mb-0">Виконав: студент групи РС-42 Марочко Єгор</p>
</footer>

</body>
</html>
