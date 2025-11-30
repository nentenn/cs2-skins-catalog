{{-- resources/views/skins/show.blade.php --}}
<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 lg:px-6 py-8 space-y-6">
        <a href="{{ url()->previous() ?: route('skins.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-yellow-400 transition">
            <span class="material-icons text-base">arrow_back</span>
            Назад до магазину
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Картинка --}}
            <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-4 flex items-center justify-center">
                <img src="{{ $skin->image_url }}" alt="{{ $skin->name }}"
                     class="w-full h-auto rounded-xl object-contain max-h-[420px]">
            </div>

            {{-- Інфо + кнопки --}}
            <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-5 space-y-4">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h1 class="text-2xl font-bold text-yellow-400">
                            {{ $skin->name }}
                        </h1>
                        <p class="text-sm text-slate-400 mt-1">
                            {{ $skin->weapon }} • {{ $skin->rarity }} • {{ $skin->condition }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-slate-400">Ціна</p>
                        <p class="text-3xl font-extrabold text-yellow-400">
                            ₴{{ number_format($skin->price, 2, '.', ' ') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 pt-1">
                    <span class="px-3 py-1 rounded-full text-[11px] font-semibold
                                 bg-slate-900/80 text-slate-100 border border-slate-600">
                        Категорія: {{ $skin->category->name ?? '—' }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-[11px] font-semibold
                                 bg-purple-500/90 text-slate-950 border border-purple-300/70">
                        {{ $skin->rarity }}
                    </span>
                    @if($skin->stat_track)
                        <span class="px-3 py-1 rounded-full text-[11px] font-semibold
                                     bg-orange-500/90 text-slate-950 border border-orange-300/70">
                            StatTrak™
                        </span>
                    @endif
                </div>

                <div class="border-t border-slate-800 pt-3 mt-1 space-y-2">
                    <h2 class="text-sm font-semibold text-slate-200">
                        Опис
                    </h2>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $skin->description ?? 'Стильний скін, який зробить твої клатчі ще красивішими.' }}
                    </p>
                </div>

                @if(!empty($skin->float_value) || !empty($skin->pattern))
                    <div class="border-t border-slate-800 pt-3 space-y-2">
                        <h2 class="text-sm font-semibold text-slate-200">
                            Характеристики
                        </h2>
                        <dl class="text-sm text-slate-300 space-y-1">
                            @if(!empty($skin->float_value))
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-400">Float:</dt>
                                    <dd class="font-mono">{{ $skin->float_value }}</dd>
                                </div>
                            @endif
                            @if(!empty($skin->pattern))
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-400">Pattern:</dt>
                                    <dd class="font-mono">{{ $skin->pattern }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                @endif

                <div class="border-t border-slate-800 pt-4 flex flex-wrap items-center justify-between gap-3">
                    <form action="{{ route('cart.add', $skin) }}" method="POST" class="flex gap-3">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold
                                       bg-yellow-400 text-slate-950 hover:bg-yellow-300 transition">
                            <span class="material-icons text-base">shopping_cart</span>
                            Додати у кошик
                        </button>
                    </form>

                    <p class="text-xs text-slate-400">
                        Миттєва доставка: скіни приходять на твій Steam-акаунт після оплати.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
