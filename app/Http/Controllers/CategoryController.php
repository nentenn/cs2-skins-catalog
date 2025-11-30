<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Список категорій
     */
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Форма створення
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Збереження нової категорії
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію створено.');
    }

    /**
     * Редагування категорії
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Оновлення категорії
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію оновлено.');
    }

    /**
     * Видалення категорії
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію видалено.');
    }
}
