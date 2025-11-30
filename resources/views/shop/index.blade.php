{{-- resources/views/shop/index.blade.php --}}
<x-app-layout>

<div class="max-w-[1600px] mx-auto px-4 lg:px-6 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-8">

        {{-- ====================== ФІЛЬТРИ ====================== --}}
        <aside class="bg-[#0A1220] border border-gray-800 rounded-2xl p-6">

            <h2 class="text-xl font-bold text-yellow-400 mb-4">Фільтри</h2>

            <form id="filtersForm" method="GET"></form>

            {{-- Пошук --}}
            <input type="text" name="search" form="filtersForm"
                   class="input-dark mb-4 w-full"
                   placeholder="Назва або опис..."
                   value="{{ request('search') }}">

            {{-- Категорія --}}
            <label class="text-gray-400 text-sm">Категорія</label>
            <select name="category" form="filtersForm" class="input-dark w-full mb-4">
                <option value="">Усі</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category')==$c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>

            {{-- Ціна --}}
            <label class="text-gray-400 text-sm">Ціна (від)</label>
            <input type="number" name="min_price" form="filtersForm"
                   class="input-dark w-full mb-3" value="{{ request('min_price') }}">

            <label class="text-gray-400 text-sm">Ціна (до)</label>
            <input type="number" name="max_price" form="filtersForm"
                   class="input-dark w-full mb-3" value="{{ request('max_price') }}">

            {{-- Рідкість --}}
            <label class="text-gray-400 text-sm">Рідкість</label>
            <select name="rarity" form="filtersForm" class="input-dark w-full mb-3">
                <option value="">Усі</option>

                @foreach([
                    'Ширпотреб',
                    'Промислове',
                    'Армійське',
                    'Заборонене',
                    'Засекречене',
                    'Таємне',
                    'Вкрай рідкісний'
                ] as $r)
                    <option value="{{ $r }}" @selected(request('rarity') == $r)>
                        {{ $r }}
                    </option>
                @endforeach
            </select>

            {{-- Якість --}}
            <label class="text-gray-400 text-sm">Якість</label>
            <select name="quality" form="filtersForm" class="input-dark w-full mb-4">
                <option value="">Усі</option>

                @foreach([
                    'Прямо з заводу',
                    'Трохи поношене',
                    'Після польових випробувань',
                    'Поношене',
                    'Загартоване в боях'
                ] as $q)
                    <option value="{{ $q }}" @selected(request('quality') == $q)>
                        {{ $q }}
                    </option>
                @endforeach
            </select>

            {{-- StatTrak --}}
            <label class="text-gray-400 text-sm">StatTrak™</label>
            <select name="stattrak" form="filtersForm" class="input-dark w-full mb-4">
                <option value="">Усі</option>
                <option value="1" @selected(request('stattrak') == '1')>Тільки StatTrak™</option>
                <option value="0" @selected(request('stattrak') == '0')>Без StatTrak™</option>
            </select>

            {{-- Сортування --}}
            <label class="text-gray-400 text-sm">Сортування</label>
            <select name="sort" form="filtersForm" class="input-dark w-full mb-4">
                <option value="">Без сортування</option>
                <option value="price_asc" @selected(request('sort')=='price_asc')>Ціна ↑</option>
                <option value="price_desc" @selected(request('sort')=='price_desc')>Ціна ↓</option>
            </select>

            <div class="flex gap-3 mt-4">
                <button form="filtersForm" class="btn-dark w-full">Фільтрувати</button>
                <a href="{{ route('shop.index') }}" class="btn-dark-outline w-full text-center">Скинути</a>
            </div>

        </aside>



        {{-- ====================== СПИСОК ТОВАРІВ ====================== --}}
        <section>

            @if($products->count())

                <div class="text-sm text-gray-400 mb-4">
                    Знайдено: 
                    <span class="text-yellow-400 font-bold">{{ $products->total() }}</span>
                </div>

              <div class="grid gap-4"
     style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
     ">






                    @foreach($products as $product)

                    <div class="bg-[#0A1220] border border-gray-800 rounded-xl p-3 flex flex-col">

    {{-- Фото --}}
    <div class="w-full h-28 bg-slate-900 rounded-lg overflow-hidden mb-2">
        <img src="{{ asset('storage/'.$product->image) }}"
             class="w-full h-full object-contain">
    </div>

    {{-- Назва --}}
    <h3 class="text-yellow-300 font-semibold text-xs leading-tight line-clamp-2 mb-1">
        {{ $product->name }}
    </h3>

    {{-- Ціна --}}
    <p class="text-yellow-400 text-sm font-bold mb-2">
        {{ number_format($product->price, 2, '.', ' ') }} ₴
    </p>

    {{-- ❤️ ДОДАТИ В УЛЮБЛЕНІ --}}
    <form action="{{ route('favorite.toggle', $product->id) }}" method="POST">
    @csrf
    <button class="w-full bg-pink-600 hover:bg-pink-500 text-white 
                   font-semibold py-1 text-xs rounded-lg flex items-center justify-center gap-1">
        ❤️ В улюблені
    </button>
</form>


    {{-- В КОРЗИНУ --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button class="w-full bg-orange-600 hover:bg-orange-500 text-white 
                   font-semibold py-1 text-xs rounded-lg flex items-center justify-center gap-1 mt-2">
         В КОРЗИНУ
    </button>
</form>


    {{-- Детальніше --}}
    <a href="{{ route('shop.show', $product->id) }}"
   class="w-full block text-center mt-2 px-3 py-1.5 rounded-lg bg-blue-600 
          hover:bg-blue-500 text-white text-xs font-semibold">
    Детальніше
</a>


</div>










                    @endforeach

                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>

            @else
                <p class="text-gray-400 text-center">Товарів не знайдено.</p>
            @endif

        </section>

    </div>

</div>

</x-app-layout>
