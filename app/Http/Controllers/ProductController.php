<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);

        $stats = [
            'users'      => User::count(),
            'products'   => Product::count(),
            'categories' => Category::count(),
        ];

        return view('admin.products.index', compact('products', 'stats'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',

            // ДОДАНО НОВІ ПОЛЯ
            'rarity'      => 'nullable|string',
            'quality'     => 'nullable|string',
            'stattrak'    => 'nullable|boolean',
        ]);

        // SLUG
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $i = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $validated['slug'] = $slug;

        // Фото
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар успішно додано!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',

            // ДОДАНО НОВІ ПОЛЯ
            'rarity'      => 'nullable|string',
            'quality'     => 'nullable|string',
            'stattrak'    => 'nullable|boolean',
        ]);

        // SLUG при зміні назви
        if ($validated['name'] !== $product->name) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $i = 1;

            while (
                Product::where('slug', $slug)
                    ->where('id', '!=', $product->id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }

            $validated['slug'] = $slug;
        }

        // Фото
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар оновлено!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Товар видалено!');
    }
}
