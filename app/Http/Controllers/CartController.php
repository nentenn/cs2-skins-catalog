<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Показ кошика
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Якщо структура десь зламалась — чисто відфільтруємо
        $clean = [];

        foreach ($cart as $productId => $item) {
            if (isset($item['product']) && isset($item['quantity'])) {
                $clean[$productId] = $item;
            }
        }

        session()->put('cart', $clean);

        return view('cart.index', [
            'items' => $clean
        ]);
    }

    /**
     * Додати товар у кошик
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        // Якщо товар уже в кошику — збільшуємо кількість
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } 
        else {
            // Додаємо новий товар
            $cart[$product->id] = [
                'product'  => $product,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Товар додано до кошика!');
    }

    /**
     * Оновити кількість товару
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Товар не знайдено у кошику.');
        }

        $quantity = max(1, intval($request->quantity));

        $cart[$id]['quantity'] = $quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Кількість оновлено!');
    }

    /**
     * Видалити товар
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Товар видалено!');
    }

    /**
     * Очистити весь кошик
     */
    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Кошик очищено!');
    }
}
