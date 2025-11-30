<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмін-панель</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#0b0b0b] text-gray-200">

<nav class="bg-[#111] border-b border-gray-800 px-6 py-4 flex justify-between items-center">
    <div class="text-2xl font-bold text-yellow-400">Адмін</div>

    <div class="flex gap-6">
        <a href="{{ route('admin.products.index') }}" class="hover:text-yellow-400">Товари</a>
        <a href="{{ route('admin.categories.index') }}" class="hover:text-yellow-400">Категорії</a>
        <a href="{{ route('shop.index') }}" class="hover:text-yellow-400">Магазин</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-400 hover:text-red-300">Вийти</button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto py-10 px-4">
    @yield('content')
</div>

</body>
</html>
