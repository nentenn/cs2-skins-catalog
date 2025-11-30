<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8 space-y-6">

        <h1 class="text-3xl font-bold text-yellow-400 mb-6">
            Улюблені товари
        </h1>

        @if($favorites->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($favorites as $fav)
                    @php $product = $fav->product; @endphp

                    @if($product)

                        {{-- === КАРТКА ЯК У МАГАЗИНІ === --}}
                        <div class="bg-[#0A1220] border border-gray-800 rounded-2xl p-4 
                                    hover:border-yellow-400 transition shadow flex flex-col">

                            {{-- Фото --}}
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 class="w-full h-44 object-contain rounded-xl mb-4">

                            {{-- Назва --}}
                            <h3 class="text-yellow-300 font-semibold mb-1 text-sm leading-tight line-clamp-3">
                                {{ $product->name }}
                            </h3>

                            {{-- Категорія --}}
                            <p class="text-gray-400 text-xs mb-3">
                                {{ $product->category->name ?? 'Без категорії' }}
                            </p>


                            {{-- Бейджі рідкості + якості --}}
                            <div class="flex flex-wrap gap-2 mb-3">

                                {{-- Рідкість --}}
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

                                @if($product->rarity)
                                    <span class="px-3 py-1 rounded-lg text-xs font-semibold {{ $rarityColors[$product->rarity] ?? 'bg-gray-700' }}">
                                        {{ $product->rarity }}
                                    </span>
                                @endif

                                {{-- Якість --}}
                                @if($product->quality)
                                    <span class="px-3 py-1 bg-slate-800 border border-slate-600 rounded-lg text-xs text-gray-200">
                                        {{ $product->quality }}
                                    </span>
                                @endif

                            </div>


                            {{-- Низ картки --}}
                            <div class="mt-auto pt-2 flex justify-between items-center">

                                {{-- Ціна --}}
                                <span class="text-yellow-400 font-bold text-base whitespace-nowrap">
                                    {{ number_format($product->price, 0, '.', ' ') }} ₴
                                </span>

                                {{-- Кнопки --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('shop.show', $product->id) }}"
                                       class="px-3 py-1.5 bg-sky-700 hover:bg-sky-600
                                              text-white text-xs font-semibold rounded-lg">
                                        Детальніше
                                    </a>

                                    <a href="{{ route('favorite.toggle', ['id' => $product->id]) }}"
                                       class="px-3 py-1.5 bg-red-600 hover:bg-red-500
                                              text-white text-xs font-bold rounded-lg">
                                        ✕
                                    </a>
                                </div>

                            </div>

                        </div>
                    @endif

                @endforeach
            </div>
        @else
            <p class="text-gray-400">
                У тебе ще немає улюблених товарів.
                Додай кілька з
                <a href="{{ route('shop.index') }}" class="text-yellow-400 hover:text-yellow-300 underline">
                    каталогу
                </a>.
            </p>
        @endif

    </div>
</x-app-layout>
