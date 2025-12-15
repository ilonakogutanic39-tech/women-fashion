<?php

namespace App\Http\Controllers;

use App\Models\Moodboard;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodboardController extends Controller
{
    public function index()
    {
        $moodboards = Auth::user()
            ->moodboards()
            ->withCount('products')
            ->get();

        return view('moodboards.index', compact('moodboards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Auth::user()->moodboards()->create([
            'name' => $request->name,
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('moodboards.index');
    }

    public function destroy(Moodboard $moodboard)
    {
        $this->authorizeMoodboard($moodboard);

        $moodboard->delete();

        return redirect()->route('moodboards.index');
    }

    public function toggleVisibility(Moodboard $moodboard)
    {
        $this->authorizeMoodboard($moodboard);

        $moodboard->is_public = ! $moodboard->is_public;
        $moodboard->save();

        return back();
    }

    public function addFromProduct(Request $request, Product $product)
    {
        $request->validate([
            'moodboard_id' => ['nullable', 'exists:moodboards,id'],
            'new_moodboard_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        if ($request->filled('new_moodboard_name')) {
            $moodboard = $user->moodboards()->create([
                'name' => $request->new_moodboard_name,
                'is_public' => false,
            ]);
        } else {
            $moodboard = $user->moodboards()
                ->where('id', $request->moodboard_id)
                ->firstOrFail();
        }

        $moodboard->products()->syncWithoutDetaching([$product->id]);

        return back()->with('status', 'product-added-to-moodboard');
    }

    public function show(Moodboard $moodboard)
    {
        $this->authorizeMoodboard($moodboard);

        $moodboard->load('products');

        return view('moodboards.show', compact('moodboard'));
    }

    public function publicShow(string $token)
    {
        $moodboard = Moodboard::where('share_token', $token)
            ->where('is_public', true)
            ->firstOrFail();

        $moodboard->load('products');

        return view('moodboards.public', compact('moodboard'));
    }

    protected function authorizeMoodboard(Moodboard $moodboard)
    {
        if (Auth::id() !== $moodboard->user_id) {
            abort(403);
        }
    }

    public function toggle(Moodboard $moodboard)
{
    $this->authorizeMoodboard($moodboard);

    // змінюємо статус
    $moodboard->is_public = ! $moodboard->is_public;

    // якщо робимо публічним – генеруємо токен
    if ($moodboard->is_public && !$moodboard->share_token) {
        $moodboard->share_token = bin2hex(random_bytes(20));
    }

    // якщо робимо приватним — можна залишити токен або очистити
    if (!$moodboard->is_public) {
        // якщо хочеш очищати токен, розкоментуй ↓
        // $moodboard->share_token = null;
    }

    $moodboard->save();

    return back()->with('status', 'moodboard-updated');
}

}
