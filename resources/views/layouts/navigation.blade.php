<div class="w-full flex justify-center bg-[#050A15] py-3">

    <nav class="bg-[#0A1220] border border-gray-700 rounded-xl 
                w-[92%] max-w-[1500px] h-14 px-6
                flex items-center justify-between shadow-lg">

        {{-- Логотип --}}
        <a href="{{ route('shop.index') }}" class="text-yellow-400 text-xl font-bold">
            PixelSkins
        </a>

        {{-- Меню --}}
        <div class="flex items-center space-x-12 text-gray-300">

            <a href="{{ route('shop.index') }}" class="hover:text-yellow-400">
                Магазин
            </a>

            <a href="{{ route('favorites.index') }}" class="hover:text-yellow-400">
                Улюблені
            </a>

            <a href="{{ route('cart.index') }}" class="hover:text-yellow-400 flex items-center gap-1">
                <span class="material-icons text-sm">shopping_cart</span>
                Кошик
            </a>

            @if(Auth::user() && Auth::user()->is_admin)
                <div class="relative group">
                    <button class="hover:text-yellow-400">
                        Admin ▾
                    </button>

                    <div class="absolute hidden group-hover:block bg-[#0A1220] border border-gray-700
                                rounded-md mt-2 p-2 w-40 z-50">
                        <a href="{{ route('admin.dashboard') }}" class="block px-2 py-1 hover:bg-gray-800 rounded">Панель</a>
                        <a href="{{ route('admin.products.index') }}" class="block px-2 py-1 hover:bg-gray-800 rounded">Товари</a>
                        <a href="{{ route('admin.categories.index') }}" class="block px-2 py-1 hover:bg-gray-800 rounded">Категорії</a>
                    </div>
                </div>
            @endif

        </div>

    </nav>

</div>

