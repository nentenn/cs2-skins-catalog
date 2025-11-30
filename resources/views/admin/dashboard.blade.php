<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold text-yellow-400 mb-6">Адмін-панель</h1>

        {{-- Блок статистики --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-6 shadow">
                <p class="text-gray-400">Користувачів:</p>
                <p class="text-3xl mt-1 font-bold text-yellow-400">{{ $stats['users'] }}</p>
            </div>

            <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-6 shadow">
                <p class="text-gray-400">Товарів:</p>
                <p class="text-3xl mt-1 font-bold text-yellow-400">{{ $stats['products'] }}</p>
            </div>

            <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-6 shadow">
                <p class="text-gray-400">Категорій:</p>
                <p class="text-3xl mt-1 font-bold text-yellow-400">{{ $stats['categories'] }}</p>
            </div>

        </div>

        {{-- Тут може бути посилання назад у адмін-товари --}}
        <a href="{{ route('admin.products.index') }}"
           class="px-5 py-2 bg-sky-600 hover:bg-sky-500 text-white rounded-xl">
            Перейти до товарів
        </a>

    </div>

</x-app-layout>
