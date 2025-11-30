<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| КОРЗИНА (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Показ кошика
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    // Додати товар (Route Model Binding)
    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    // Оновити кількість товару
    Route::put('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    // Видалити товар
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // Очистити весь кошик користувача
    Route::delete('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    //  Тимчасовий маршрут для очищення пошкоджених даних у сесії
    Route::get('/cart/fix/clear-session', function () {
        session()->forget('cart');
        return redirect()->route('cart.index')
                         ->with('success', 'Кеш кошика успішно очищено!');
    })->name('cart.fix');
});


/*
|--------------------------------------------------------------------------
| Магазин
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'index'])
    ->name('shop.index');

// Якщо хочеш, можеш зробити Route Model Binding і тут,
// тоді у ShopController::show можна приймати Product $product
Route::get('/shop/{id}', [ShopController::class, 'show'])
    ->name('shop.show');

Route::resource('products', ProductController::class);

/*
|--------------------------------------------------------------------------
| Авторизований користувач
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Профіль
    Route::get('/profile', [UserProfileController::class, 'index'])
        ->name('user.profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Улюблені
    |--------------------------------------------------------------------------
    */

    // Список улюблених
    Route::get('/favorites', [FavoriteController::class, 'list'])
        ->name('favorites.index');

    // Додати/прибрати
    Route::post('/favorite/{id}', [FavoriteController::class, 'toggle'])
        ->name('favorite.toggle');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Адмінка
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });

require __DIR__.'/auth.php';
