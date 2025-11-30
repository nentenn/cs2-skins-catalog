<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'PixelSkins' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            background: #0a0a0a;
            color: #f1f5f9;
        }
    </style>
</head>

<body class="min-h-screen">

{{-- ======================= NAVBAR ======================= --}}
<nav class="bg-slate-950 border-b border-slate-800 px-4 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between">

        {{-- ЛОГО --}}
        <a href="{{ route('shop.index') }}"
           class="text-xl font-bold text-yellow-400 hover:text-yellow-300">
            PixelSkins
        </a>
        {{-- Магазин --}}
<a href="{{ route('shop.index') }}" class="text-white hover:text-yellow-400">
    Магазин
</a>

{{-- Якщо користувач авторизований --}}
@auth

    {{-- Улюблені --}}
    <a href="{{ route('favorites.index') }}" class="text-white hover:text-yellow-400">
        Улюблені
    </a>

    {{-- КОШИК --}}
    <a href="{{ route('cart.index') }}"
       class="relative px-3 py-2 text-white hover:text-yellow-400 transition">

        🛒 Кошик

        @if(session('cart') && count(session('cart')) > 0)
            <span class="absolute -top-1 -right-1 bg-red-600 text-xs text-white
                         px-1.5 py-0.5 rounded-full">
                {{ count(session('cart')) }}
            </span>
        @endif
    </a>

    {{-- ADMIN DROPDOWN --}}
    @if(auth()->user()->is_admin)
        <div x-data="{ open: false }" class="relative">

            <button @click="open = !open"
                    class="text-white hover:text-yellow-400 transition flex items-center gap-1">
                Admin
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false"
                 class="absolute bg-[#111] border border-gray-700 mt-2 rounded-lg shadow-xl w-40">

                <a href="{{ route('admin.products.index') }}"
                   class="block px-4 py-2 hover:bg-gray-800">Товари</a>

                <a href="{{ route('admin.categories.index') }}"
                   class="block px-4 py-2 hover:bg-gray-800">Категорії</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block text-left w-full px-4 py-2 hover:bg-gray-800 text-red-400">
                        Вийти
                    </button>
                </form>

            </div>
        </div>
    @endif

    {{-- USER NAME --}}
    <span class="text-slate-300">{{ Auth::user()->name }}</span>

@endauth


{{-- Якщо користувач НЕ авторизований --}}
@guest
    <a href="{{ route('login') }}" class="text-white hover:text-yellow-400">
        Увійти
    </a>
@endguest

        </div>
    </div>
</nav>
{{-- ======================= END NAVBAR ======================= --}}



{{-- ======================= CONTENT ======================= --}}
<main class="py-6 max-w-7xl mx-auto px-4">

    {{ $slot ?? '' }}

    @yield('content')

</main>

</body>
</html>
