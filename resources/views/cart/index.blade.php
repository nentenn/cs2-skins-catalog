{{-- resources/views/cart/index.blade.php --}}
<x-app-layout>

<div class="max-w-7xl mx-auto px-4 lg:px-6 py-8 space-y-8">

    {{-- Заголовок --}}
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-yellow-400">Кошик</h1>

        <div class="flex items-center gap-4">
            {{-- Кнопка очистити кеш кошика --}}
            <a href="{{ route('cart.fix') }}"
               class="px-4 py-2 bg-red-700 hover:bg-red-600 text-white rounded-xl">
                Очистити кеш кошика
            </a>

            {{-- Повернутись до каталогу --}}
            <a href="{{ route('shop.index') }}" class="text-gray-400 hover:text-yellow-400">
                ← Повернутись до каталогу
            </a>
        </div>
    </div>

    @if(count($items))

        @php $total = 0; @endphp

        <div class="space-y-5">

            {{-- Перебір товарів у кошику --}}
            @foreach($items as $id => $item)

                @php
                    $p   = $item['product'];
                    $qty = $item['quantity'];
                    $total += $p->price * $qty;

                    $rarityColors = [
                        'Ширпотреб'        => 'bg-gray-600 text-white',
                        'Промислове'       => 'bg-blue-600 text-white',
                        'Армійське'        => 'bg-green-600 text-white',
                        'Заборонене'       => 'bg-purple-600 text-white',
                        'Засекречене'      => 'bg-pink-600 text-white',
                        'Таємне'           => 'bg-red-600 text-white',
                        'Вкрай рідкісний'  => 'bg-yellow-500 text-black',
                    ];
                @endphp

                <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-5 flex flex-col sm:flex-row gap-6">

                    {{-- Фото --}}
                    <div class="w-40 h-40 bg-slate-900 rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-full object-contain">
                    </div>

                    {{-- Основний блок --}}
                    <div class="flex-1 space-y-3">

                        {{-- Назва --}}
                        <h2 class="text-xl font-bold text-yellow-300">{{ $p->name }}</h2>

                        {{-- Категорія --}}
                        <p class="text-gray-400 text-sm">{{ $p->category->name ?? 'Без категорії' }}</p>

                        {{-- Теги --}}
                        <div class="flex flex-wrap gap-2 text-xs font-semibold">

                            @if($p->rarity)
                                <span class="px-3 py-1 rounded-lg {{ $rarityColors[$p->rarity] ?? 'bg-slate-700 text-white' }}">
                                    {{ $p->rarity }}
                                </span>
                            @endif

                            @if($p->quality)
                                <span class="px-3 py-1 bg-slate-800 border border-slate-600 text-white rounded-lg">
                                    {{ $p->quality }}
                                </span>
                            @endif

                            @if($p->stattrak)
                                <span class="px-3 py-1 bg-orange-600 text-white rounded-lg">
                                    StatTrak™
                                </span>
                            @endif

                            <span class="px-3 py-1 bg-slate-700 text-gray-200 rounded-lg">
                                ID: {{ $p->id }}
                            </span>

                        </div>

                        {{-- Оновлення кількості --}}
                        <form action="{{ route('cart.update', ['id' => $p->id]) }}"
                              method="POST"
                              class="flex items-center gap-3 mt-3">

                            @csrf
                            @method('PUT')

                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   value="{{ $qty }}"
                                   class="w-24 bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-gray-100">

                            <button class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white">
                                Оновити
                            </button>
                        </form>

                    </div>

                    {{-- Праворуч: ціна + видалення --}}
                    <div class="flex flex-col justify-between items-end">

                        {{-- Ціна --}}
                        <p class="text-yellow-400 text-2xl font-bold">
                            ₴{{ number_format($p->price * $qty, 0, '.', ' ') }}
                        </p>

                        {{-- Видалити --}}
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-500">
                                Видалити
                            </button>
                        </form>
                    </div>

                </div>

            @endforeach

        </div>

        {{-- Підсумок --}}
        <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-6 flex justify-between mt-8">
            <span class="text-gray-300">До сплати:</span>
            <span class="text-yellow-400 text-3xl font-bold">
                ₴{{ number_format($total, 0, '.', ' ') }}
            </span>
        </div>

    @else

        {{-- Порожній кошик --}}
        <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-10 text-center text-gray-400">
            Кошик порожній 🙃  
            <br>
            <a href="{{ route('shop.index') }}" class="text-yellow-400 hover:text-yellow-300 underline">
                Переглянути товари
            </a>
        </div>

    @endif

</div>

</x-app-layout>
