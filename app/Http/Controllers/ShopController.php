<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // =======================
    //   ГОЛОВНА СТОРІНКА (Каталог)
    // =======================
    public function index(Request $request)
    {
        $query = Product::with('category');
        $categories = Category::all();

        // ---------- ПОШУК ----------
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // ---------- КАТЕГОРІЯ ----------
        if ($categoryId = $request->get('category')) {
            $query->where('category_id', $categoryId);
        }

        // ---------- ЦІНА ----------
        if ($min = $request->get('min_price')) {
            $query->where('price', '>=', $min);
        }
        if ($max = $request->get('max_price')) {
            $query->where('price', '<=', $max);
        }

        // ---------- РІДКІСТЬ ----------
if ($rarity = $request->get('rarity')) {
    $query->where('rarity', $rarity);
}

// ---------- ЯКІСТЬ ----------
if ($quality = $request->get('quality')) {
    $query->where('quality', $quality);
}

// ---------- STATTRAK ----------
if (!is_null($request->get('stattrak'))) {
    if ($request->get('stattrak') === "1") {
        $query->where('stattrak', 1);
    } elseif ($request->get('stattrak') === "0") {
        $query->where('stattrak', 0);
    }
}



        // ---------- СОРТУВАННЯ ----------
        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        // ---------- ПАГІНАЦІЯ ----------
        $products = $query->paginate(12)->withQueryString();


        // ---------- УЛЮБЛЕНІ ТОВАРИ КОРИСТУВАЧА ----------
        $favoriteIds = [];
        if (auth()->check()) {
            $favoriteIds = auth()->user()
                ->favorites()
                ->pluck('product_id')
                ->toArray();
        }

        // ---------- СТАТИСТИКА ДЛЯ ГОЛОВНОЇ ----------
        $stats = [
            'users'      => User::count(),
            'products'   => Product::count(),
            'categories' => Category::count(),
        ];

        return view('shop.index', [
            'products'    => $products,
            'categories'  => $categories,
            'favoriteIds' => $favoriteIds,
            'stats'       => $stats,
        ]);
    }



    // =======================
    //   ДЕТАЛЬНА СТОРІНКА
    // =======================
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Схожі товари
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Чи улюблений
        $isFavorite = auth()->check()
            ? auth()->user()->favorites()->where('product_id', $product->id)->exists()
            : false;

        return view('shop.show', compact('product', 'related', 'isFavorite'));
    }
}
