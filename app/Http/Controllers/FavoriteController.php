<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    // Додати / забрати з улюблених
    public function toggle($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id'    => $user->id,
                'product_id' => $product->id,
            ]);
        }

        return back();
    }

    // Список улюблених
    public function list()
    {
        $favorites = auth()->user()
            ->favorites()
            ->with('product.category')
            ->get();

        return view('favorites.index', compact('favorites'));
    }
}
