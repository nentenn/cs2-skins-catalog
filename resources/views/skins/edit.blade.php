{{-- resources/views/admin/skins/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 lg:px-6 py-8 space-y-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-yellow-400">
                    Редагувати скін: {{ $skin->name }}
                </h1>
                <p class="text-sm text-slate-400">
                    Внеси зміни й натисни «Оновити».
                </p>
            </div>

            <a href="{{ route('admin.skins.index') }}"
               class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-yellow-400 transition">
                <span class="material-icons text-base">arrow_back</span>
                До списку
            </a>
        </div>

        <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-5 space-y-4">
            <form action="{{ route('admin.skins.update', $skin) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Далі — абсолютно ті ж поля, як у create.blade.php,
                     тільки замість old('name') → old('name', $skin->name) і т.д. --}}

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">
                        Назва скіна
                    </label>
                    <input type="text" name="name" value="{{ old('name', $skin->name) }}" required
                           class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('name')
                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Зброя
                        </label>
                        <input type="text" name="weapon" value="{{ old('weapon', $skin->weapon) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Категорія
                        </label>
                        <select name="category_id"
                                class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option value="">Оберіть...</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected(old('category_id', $skin->category_id) == $c->id)>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Рідкість
                        </label>
                        <input type="text" name="rarity" value="{{ old('rarity', $skin->rarity) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Стан (wear)
                        </label>
                        <input type="text" name="condition" value="{{ old('condition', $skin->condition) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Float
                        </label>
                        <input type="text" name="float_value" value="{{ old('float_value', $skin->float_value) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            Pattern
                        </label>
                        <input type="text" name="pattern" value="{{ old('pattern', $skin->pattern) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-2 mt-1">
                        <input type="checkbox" id="stat_track" name="stat_track" value="1"
                               class="w-4 h-4 rounded border-slate-600 bg-slate-900 text-yellow-400 focus:ring-yellow-400"
                               @checked(old('stat_track', $skin->stat_track))>
                        <label for="stat_track" class="text-sm text-slate-200">
                            StatTrak™
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">
                            URL зображення
                        </label>
                        <input type="text" name="image_url" value="{{ old('image_url', $skin->image_url) }}"
                               class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">
                        Ціна (₴)
                    </label>
                    <input type="number" step="0.01" min="0" name="price"
                           value="{{ old('price', $skin->price) }}" required
                           class="w-40 bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">
                        Короткий опис
                    </label>
                    <input type="text" name="short_description"
                           value="{{ old('short_description', $skin->short_description) }}"
                           class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">
                        Повний опис
                    </label>
                    <textarea name="description" rows="4"
                              class="w-full bg-slate-950/80 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description', $skin->description) }}</textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <a href="{{ route('admin.skins.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold
                              border border-slate-600 bg-slate-950 hover:bg-slate-900 text-slate-100 transition">
                        Скасувати
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-semibold
                                   bg-yellow-400 text-slate-950 hover:bg-yellow-300 transition">
                        Оновити
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
