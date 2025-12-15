<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // список товарів + пошук + фільтрація
    public function index(Request $request)
{
    $query = Product::query();

    // Пошук
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // Категорія
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Ціна від
    if ($request->filled('price_from')) {
        $query->where('price', '>=', $request->price_from);
    }

    // Ціна до
    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    $products = $query->paginate(12)->withQueryString();
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}


    // детальний перегляд товару
    public function show(Product $product)
    {
        $product->load('category');

        $moodboards = collect();

        if (Auth::check()) {
            $moodboards = Auth::user()
                ->moodboards()
                ->withCount('products')
                ->get();
        }

        return view('products.show', [
            'product'    => $product,
            'moodboards' => $moodboards,
        ]);
    }

    // форма створення
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // збереження нового товару
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:2|max:150',
            'description' => 'nullable|max:2000',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // завантаження фото
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Товар успішно додано.');
    }

    // форма редагування
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // оновлення товару
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|min:2|max:150',
            'description' => 'nullable|max:2000',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // заміна фото
        if ($request->hasFile('image')) {

            // видаляємо старе фото
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Товар оновлено.');
    }

    // видалення товару
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Товар видалено.');
    }
    
    public function adminIndex()
{
    $products = Product::with('category')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.products.index', compact('products'));
}

}
