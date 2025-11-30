<x-app-layout>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-yellow-400">Редагувати товар</h2>
        <p class="text-slate-400">Онови інформацію та натисни "Зберегти".</p>
    </div>

    <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Назва --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Назва товару</label>
                <input type="text" name="name" value="{{ $product->name }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100" required>
            </div>

            {{-- Категорія --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Категорія</label>
                <select name="category_id"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected($c->id == $product->category_id)>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ціна --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Ціна (₴)</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                       class="w-40 bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100" required>
            </div>

            {{-- Опис --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">{{ $product->description }}</textarea>
            </div>

            {{-- Рідкість --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Рідкість</label>
                <select name="rarity"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">
                    <option value="">Не вказано</option>
                    @foreach([
                        'Ширпотреб',
                        'Промислове',
                        'Армійське',
                        'Заборонене',
                        'Засекречене',
                        'Таємне',
                        'Вкрай рідкісний'
                    ] as $r)
                        <option value="{{ $r }}" @selected($product->rarity == $r)>{{ $r }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Якість --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Якість</label>
                <select name="quality"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">
                    <option value="">Не вказано</option>
                    @foreach([
                        'Прямо з заводу',
                        'Трохи поношене',
                        'Після польових випробувань',
                        'Поношене',
                        'Загартоване в боях'
                    ] as $q)
                        <option value="{{ $q }}" @selected($product->quality == $q)>{{ $q }}</option>
                    @endforeach
                </select>
            </div>

            {{-- StatTrak --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">StatTrak™</label>
                <select name="stattrak"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">
                    <option value="0" @selected(!$product->stattrak)>Ні</option>
                    <option value="1" @selected($product->stattrak)>Так</option>
                </select>
            </div>

            {{-- Поточне фото --}}
            @if($product->image)
                <div>
                    <p class="text-sm text-slate-400">Поточне фото:</p>
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-32 h-32 rounded-xl border border-slate-700">
                </div>
            @endif

            {{-- Нове фото --}}
            <div>
                <label class="text-sm text-slate-300 font-semibold">Оновити фото</label>
                <input type="file" name="image"
                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-slate-100">
            </div>

            {{-- Кнопки --}}
            <div class="flex gap-3 pt-2">
                <button class="px-5 py-2 bg-yellow-400 hover:bg-yellow-300 text-black font-semibold rounded-xl">
                    Зберегти
                </button>

                <a href="{{ route('admin.products.index') }}"
                   class="px-5 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-xl">
                    Назад
                </a>
            </div>
        </form>
    </div>

</x-app-layout>
