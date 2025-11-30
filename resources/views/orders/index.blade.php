{{-- resources/views/orders/index.blade.php --}}
<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 lg:px-6 py-8 space-y-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-yellow-400">
                    Мої замовлення
                </h1>
                <p class="text-sm text-slate-400">
                    Тут зберігається історія всіх покупок.
                </p>
            </div>

            <a href="{{ route('skins.index') }}"
               class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-yellow-400 transition">
                <span class="material-icons text-base">storefront</span>
                До магазину
            </a>
        </div>

        @if($orders->count())
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-4 space-y-3">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-slate-100">
                                    Замовлення #{{ $order->id }}
                                </p>
                                <p class="text-xs text-slate-400">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </p>
                            </div>

                            <div class="flex flex-col items-end">
                                <p class="text-xs text-slate-400">Сума</p>
                                <p class="text-xl font-bold text-yellow-400">
                                    ₴{{ number_format($order->total, 2, '.', ' ') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-800 pt-3">
                            <div class="flex flex-wrap gap-2">
                                @foreach($order->items as $item)
                                    <span class="px-3 py-1 rounded-full text-[11px] font-semibold
                                                 bg-slate-900 text-slate-100 border border-slate-700">
                                        {{ $item->skin->name ?? 'Скін' }} × {{ $item->quantity }}
                                    </span>
                                @endforeach
                            </div>

                            <div>
                                <span class="px-3 py-1.5 rounded-full text-[11px] font-semibold
                                             @class([
                                                 'bg-emerald-500/90 text-slate-950 border border-emerald-300/70' => $order->status === 'paid',
                                                 'bg-yellow-400/90 text-slate-950 border border-yellow-200/80' => $order->status === 'pending',
                                                 'bg-red-500/90 text-slate-950 border border-red-300/70' => $order->status === 'canceled',
                                             ])>
                                    {{ strtoupper($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-slate-950/70 border border-slate-800 rounded-2xl p-6 text-center text-slate-300">
                У тебе ще не було замовлень.
            </div>
        @endif
    </div>
</x-app-layout>
