<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200">
            Категорії скінів
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-200">Список категорій</h3>

            <a href="{{ route('admin.categories.create') }}"
               class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-400 transition">
                + Додати категорію
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#0b0b0f] shadow-sm sm:rounded-lg p-4 border border-gray-700">
            <table class="w-full text-sm text-gray-200">
                <thead class="bg-[#111827] border-b border-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Назва</th>
                        <th class="px-4 py-2 text-left">Slug</th>
                        <th class="px-4 py-2 text-right">Дії</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-gray-800">
                            <td class="px-4 py-2">{{ $category->id }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2 text-gray-400">{{ $category->slug }}</td>

                            <td class="px-4 py-2 text-right space-x-3 flex justify-end">

                                {{-- Кнопка редагування --}}
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-yellow-400 hover:underline">
                                    Редагувати
                                </a>

                                {{-- Кнопка видалення категорії --}}
                                <form action="{{ route('admin.categories.destroy', $category) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Видалити категорію?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500">
                                        Видалити
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                Немає категорій.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
