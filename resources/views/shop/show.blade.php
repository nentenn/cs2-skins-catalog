<x-app-layout>
    <style>
        .product-img-box {
            background: #0A1220;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 20px;
        }

        .product-img-box img {
            width: 100%;
            max-height: 380px;
            object-fit: contain;
        }

        .badge-block span {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-block;
        }

        .character-box {
            background: #0A1220;
            border: 1px solid #1e293b;
            border-radius: 14px;
            padding: 20px;
        }

        .similar-card {
            background: #0A1220;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 14px;
            transition: 0.2s;
        }

        .similar-card:hover {
            border-color: #facc15;
        }

        .similar-card img {
            height: 160px;
            width: 100%;
            object-fit: contain;
            border-radius: 12px;
        }
    </style>

    <div class="max-w-6xl mx-auto px-4 lg:px-6 py-10 space-y-12">

        {{-- =========================== ГОЛОВНИЙ БЛОК =========================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- ======================= ЛІВА ЧАСТИНА (ФОТО + БЕЙДЖІ) ======================= --}}
            <div class="product-img-box">

                {{-- Фото --}}
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">

                {{-- Бейджі --}}
                <div class="badge-block flex flex-wrap gap-2 mt-4">

                    <span class="bg-sky-700/40 border border-sky-500 text-sky-300">
                        {{ $product->category->name ?? 'Без категорії' }}
                    </span>

                    @php
                        $rarityColors = [
                            'Ширпотреб' => 'bg-gray-600 text-white',
                            'Промислове' => 'bg-blue-600 text-white',
                            'Армійське' => 'bg-green-600 text-white',
                            'Заборонене' => 'bg-purple-600 text-white',
                            'Засекречене' => 'bg-pink-600 text-white',
                            'Таємне' => 'bg-red-600 text-white',
                            'Вкрай рідкісний' => 'bg-yellow-500 text-black',
                        ];
                    @endphp

                    {{-- Рідкість --}}
                    @if($product->rarity)
                        <span class="{{ $rarityColors[$product->rarity] ?? 'bg-gray-700 text-white' }}">
                            {{ $product->rarity }}
                        </span>
                    @endif

                    {{-- Якість --}}
                    @if($product->quality)
                        <span class="bg-slate-700 text-white border border-slate-500">
                            {{ $product->quality }}
                        </span>
                    @endif

                    {{-- StatTrak --}}
                    @if($product->stattrak)
                        <span class="bg-orange-600 text-white">
                            StatTrak™
                        </span>
                    @endif

                    <span class="bg-slate-700 text-gray-300 border border-slate-500">
                        ID: {{ $product->id }}
                    </span>
                </div>

            </div>



            {{-- ======================= ПРАВА ЧАСТИНА (ІНФО) ======================= --}}
            <div class="flex flex-col gap-6">

                {{-- Назва + Обране --}}
                <div class="flex justify-between items-start">
                    <h1 class="text-3xl font-bold text-yellow-400 leading-tight">
                        {{ $product->name }}
                    </h1>

                    @auth
                        <a href="{{ route('favorite.toggle', $product->id) }}"
                           class="text-3xl transition
                               {{ $isFavorite ? 'text-red-500' : 'text-gray-500 hover:text-red-400' }}">
                            
                        </a>
                    @endauth
                </div>

                {{-- Ціна --}}
                <div>
                    <p class="text-sm uppercase text-gray-400">Ціна</p>
                    <p class="text-4xl font-bold text-yellow-400">
                        {{ number_format($product->price, 0, '.', ' ') }} ₴
                    </p>
                </div>

                {{-- Характеристики --}}
                <div class="character-box">
                    <h3 class="text-yellow-300 text-lg font-semibold mb-2">Характеристики</h3>

                    <div class="text-gray-300 text-sm space-y-1">
                        <p><span class="text-gray-400">Категорія:</span> {{ $product->category->name ?? '—' }}</p>
                        <p><span class="text-gray-400">Рідкість:</span> {{ $product->rarity ?? '—' }}</p>
                        <p><span class="text-gray-400">Якість:</span> {{ $product->quality ?? '—' }}</p>
                        <p><span class="text-gray-400">StatTrak™:</span> {{ $product->stattrak ? 'Так' : 'Ні' }}</p>
                    </div>
                </div>

                {{-- Опис --}}
                <div>
                    <p class="text-sm uppercase text-gray-400 mb-1">Опис</p>
                    <p class="text-gray-200 text-sm leading-relaxed">
                        {{ $product->description ?: 'Опис відсутній.' }}
                    </p>
                </div>

                {{-- Назад --}}
                <a href="{{ route('shop.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white px-5 py-2 rounded-xl text-center w-fit">
                    ← Назад до каталогу
                </a>
            </div>
        </div>



        {{-- =========================== СХОЖІ ТОВАРИ =========================== --}}
        @if($related->count())
            <div>
                <h2 class="text-2xl font-bold text-yellow-400 mb-4">Схожі товари</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

                    @foreach($related as $item)
                        <div class="similar-card">

                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->name }}">

                            <h3 class="text-yellow-300 font-semibold mt-3 text-sm line-clamp-2">
                                {{ $item->name }}
                            </h3>

                            <p class="text-gray-400 text-xs mb-2">
                                {{ $item->category->name ?? 'Без категорії' }}
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-yellow-400 font-bold text-sm">
                                    {{ number_format($item->price, 0, '.', ' ') }} ₴
                                </span>

                                <a href="{{ route('shop.show', $item->id) }}"
                                   class="px-3 py-1.5 bg-sky-700 hover:bg-sky-600 text-white text-xs rounded-lg">
                                    Детальніше
                                </a>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    </div>
</x-app-layout>
