{{-- resources/views/admin/skins/index.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8 space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-yellow-400">
                    Адмін-панель: Скіни
                </h1>
                <p class="text-sm text-slate-400">
                    Керуй каталогом магазинe: додавай, редагуй, видаляй скіни.
                </p>
            </div>

            <a href="{{ route('admin.skins.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                      bg-yellow-400 text-slate-950 hover:bg-yellow-300 transition">
                <span class="material-icons text-base">add</span>
                Додати скін
            </a>
        </div>

        <div class="bg-slate-950/70 border border-slate-800 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-slate-300">
                    <thead class="bg-slate-900/80 text-xs uppercase text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Картинка</th>
                            <th class="px-4 py-3">Назва</th>
                            <th class="px-4 py-3">Зброя</th>
                            <th class="px-4 py-3">Категорія</th>
                            <th class="px-4 py-3">Рідкість</th>
                            <th class="px-4 py-3">Ціна, ₴</th>
                            <th class="px-4 py-3 text-right">Дії</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($skins as $skin)
                            <tr class="hover:bg-slate-900/60">
                                <td class="px-4 py-3 text-xs text-slate-400">
                                    #{{ $skin->id }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-900">
                                        <img src="{{ $skin->image_url }}" alt="{{ $skin->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-semibold text-slate-100">
                                        {{ $skin->name }}
                                    </div>
                                    <div class="text-xs text-slate-400">
                                        {{ Str::limit($skin->short_description ?? '', 40) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-300">
                                    {{ $skin->weapon }}
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-300">
                                    {{ $skin->category->name ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold
                                                 bg-purple-500/90 text-slate-950 border border-purple-300/70">
                                        {{ $skin->rarity }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-yellow-400">
                                    ₴{{ number_format($skin->price, 2, '.', ' ') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('skins.show', $skin) }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-semibold
                                                  border border-slate-600 bg-slate-950 hover:bg-slate-900 text-slate-100 transition">
                                            Перегляд
                                        </a>

                                        <a href="{{ route('admin.skins.edit', $skin) }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-semibold
                                                  bg-sky-500/90 text-slate-950 hover:bg-sky-400 transition">
                                            Редагувати
                                        </a>

                                        <form action="{{ route('admin.skins.destroy', $skin) }}" method="POST"
                                              onsubmit="return confirm('Точно видалити цей скін?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-semibold
                                                           bg-red-500/90 text-slate-950 hover:bg-red-400 transition">
                                                Видалити
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(!$skins->count())
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-slate-400">
                                    Немає жодного скіна в каталозі.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-800 p-3">
                {{ $skins->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
