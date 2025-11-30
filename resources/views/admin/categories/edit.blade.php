<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Редагування: {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Назва категорії</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                           class="w-full border rounded px-2 py-1">
                    @error('name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.categories.index') }}"
                       class="px-4 py-2 border rounded">
                        Назад
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Оновити
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
