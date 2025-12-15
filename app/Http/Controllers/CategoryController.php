<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // список категорій
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    // форма створення
    public function create()
    {
        return view('categories.create');
    }

    // збереження нової категорії
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'description' => 'nullable|max:500',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Категорію успішно створено.');
    }

    // форма редагування
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // оновлення категорії
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'description' => 'nullable|max:500',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Категорію оновлено.');
    }

    // видалення
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Категорію видалено.');
    }
}
