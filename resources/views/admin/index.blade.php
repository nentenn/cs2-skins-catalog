<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-yellow-400 mb-6">Адмін-панель</h1>

        <div class="flex gap-4 mb-8">
            <a href="{{ route('admin.categories.create') }}" class="btn-main">
                + Створити категорію
            </a>

            <a href="{{ route('admin.products.create') }}" class="btn-main">
                + Додати товар
            </a>
        </div>

        {{-- тут далі твоя статистика: кількість товарів, категорій, користувачів і т.д. --}}
    </div>
</x-app-layout>
