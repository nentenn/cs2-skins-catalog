<x-app-layout>

<div class="max-w-[1600px] mx-auto px-6 py-10">

    {{-- Заголовок --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-yellow-400">Товари</h1>

        <div class="flex gap-3">
            <a href="{{ route('admin.categories.create') }}"
               class="px-4 py-2 bg-sky-600 hover:bg-sky-500 text-white rounded-xl">
                + Категорія
            </a>

            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded-xl">
                + Товар
            </a>
        </div>
    </div>


    {{-- ≡ ≡ ≡  Блок статистики  ≡ ≡ ≡ --}}
    <div class="flex gap-10 bg-[#0A1220] border border-gray-800 rounded-2xl p-6 mb-10">

        <div class="text-gray-300 text-lg">
            Користувачів:
            <span class="text-yellow-400 font-bold">{{ $stats['users'] }}</span>
        </div>

        <div class="text-gray-300 text-lg">
            Товарів:
            <span class="text-yellow-400 font-bold">{{ $stats['products'] }}</span>
        </div>

        <div class="text-gray-300 text-lg">
            Категорій:
            <span class="text-yellow-400 font-bold">{{ $stats['categories'] }}</span>
        </div>

    </div>
    {{-- ≡ ≡ ≡ End статистики ≡ ≡ ≡ --}}



    {{-- Таблиця товарів --}}
    <div class="bg-[#0B1120] border border-gray-800 rounded-2xl overflow-hidden">

        <table class="w-full text-left">
    <thead class="bg-[#0F172A] text-gray-400 text-sm uppercase">
        <tr>
            <th class="p-4">ID</th>
            <th class="p-4">Зображення</th>
            <th class="p-4">Назва</th>
            <th class="p-4">Категорія</th>
            <th class="p-4">Характеристики</th> {{-- НОВЕ --}}
            <th class="p-4">Ціна</th>
            <th class="p-4 text-right">Дії</th>
        </tr>
    </thead>

    <tbody class="text-gray-200">

        @foreach($products as $product)
        <tr class="border-t border-gray-800 hover:bg-[#131b2f] transition">

            <td class="p-4 text-gray-400">#{{ $product->id }}</td>

            <td class="p-4">
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="h-12 w-12 object-contain rounded-lg">
            </td>

            <td class="p-4 font-semibold">
                {{ $product->name }}
            </td>

            <td class="p-4 text-gray-400">
                {{ $product->category->name ?? '—' }}
            </td>

{{-- Характеристики --}}
<td class="p-4 flex gap-2">

    {{-- ========== РІДКІСТЬ (кольорова) ========== --}}
    @php
        $rarityColors = [
            'Ширпотреб' => 'bg-gray-600 text-white',
            'Промислове' => 'bg-blue-600 text-white',
            'Армійське' => 'bg-green-600 text-white',
            'Заборонене' => 'bg-purple-600 text-white',
            'Засекречене' => 'bg-pink-600 text-white',
            'Таємне' => 'bg-red-600 text-white',
            'Вкрай рідкісний' => 'bg-yellow-400 text-black',
        ];
    @endphp

    <span class="px-3 py-1 text-xs rounded-lg {{ $rarityColors[$product->rarity] ?? 'bg-gray-700 text-white' }}">
        {{ $product->rarity }}
    </span>

    {{-- ========== ЯКІСТЬ ========== --}}
    <span class="px-3 py-1 text-xs rounded-lg bg-gray-800 border border-gray-600 text-gray-200">
        {{ $product->quality }}
    </span>

    {{-- ========== StatTrak ========== --}}
    @if($product->stattrak)
        <span class="px-3 py-1 text-xs rounded-lg bg-orange-500 text-white font-semibold">
            StatTrak™
        </span>
    @endif

</td>




<td class="p-4 text-yellow-400 font-bold whitespace-nowrap">
    ₴{{ number_format($product->price, 2, '.', ' ') }}
</td>

            <td class="p-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="px-3 py-1 text-xs rounded-lg bg-blue-600 hover:bg-blue-500 text-white">
            Редагувати
        </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 text-xs rounded-lg bg-red-600 hover:bg-red-500 text-white">
                Видалити
            </button>
        </form>


            </td>

        </tr>
        @endforeach

    </tbody>
</table>


    </div>

</div>

</x-app-layout>
