<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 lg:px-6 py-8 space-y-8">

        <h1 class="text-3xl font-bold text-yellow-400 mb-4">
            Профіль
        </h1>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Основна інформація --}}
            <div class="bg-[#020617] border border-gray-800 rounded-2xl p-5 space-y-3">
                <h2 class="text-xl font-semibold">Основна інформація</h2>

                <p><span class="text-gray-400 text-sm">Ім'я: </span>{{ $user->name }}</p>
                <p><span class="text-gray-400 text-sm">Email: </span>{{ $user->email }}</p>
                <p><span class="text-gray-400 text-sm">Роль: </span>{{ $user->role ?? 'user' }}</p>

                <a href="{{ route('profile.edit') }}" class="btn-secondary mt-2 inline-flex">
                    Редагувати профіль
                </a>
            </div>

            {{-- Статистика --}}
            <div class="bg-[#020617] border border-gray-800 rounded-2xl p-5 space-y-3">
                <h2 class="text-xl font-semibold">Статистика</h2>
                <p>
                    Улюблених товарів:
                    <span class="text-yellow-400 font-bold">{{ $favoritesCount }}</span>
                </p>
            </div>
        </div>

    </div>
</x-app-layout>
