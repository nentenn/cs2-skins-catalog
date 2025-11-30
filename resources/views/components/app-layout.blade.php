<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'CS2 Skins Store' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100">

    {{-- NAVBAR --}}
    @include('layouts.navigation')

    {{-- HEADER (дуже важливо!) --}}
    @if (isset($header))
        <header class="max-w-7xl mx-auto px-4 py-4">
            {{ $header }}
        </header>
    @endif

    {{-- CONTENT --}}
    <main class="py-6 max-w-7xl mx-auto px-4">
        {{ $slot }}
    </main>

</body>
</html>
