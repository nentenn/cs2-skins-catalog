<x-app-layout>
    <div class="max-w-md mx-auto px-4 py-8">

        <h1 class="text-2xl font-bold text-yellow-400 mb-6">Редагувати категорію</h1>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-300 mb-1">Назва</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="w-full rounded bg-[#151515] border border-gray-700 text-white p-2">
                @error('name') <p class="text-red-400 text-sm">{{ $message }}</p> @enderror
            </div>

            <button class="btn-main">Зберегти</button>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-400 text-sm ml-3">Назад</a>
        </form>

    </div>
</x-app-layout>
