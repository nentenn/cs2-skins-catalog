<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-yellow-400">
            Створити категорію
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 panel-dark p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <label class="block text-sm mb-1 text-gray-300">
                Назва
            </label>
            <input type="text"
                   name="name"
                   class="input-dark"
                   placeholder="Наприклад: Ножі"
                   value="{{ old('name') }}">

            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror

            <div class="mt-6">
                <button type="submit" class="btn-blue">
                    Створити
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
