<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoodboardController;

/*
|--------------------------------------------------------------------------
| Головна сторінка → Публічний каталог
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');


/*
|--------------------------------------------------------------------------
| Публічні маршрути (доступні всім)
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// ...

Route::middleware('auth')->group(function () {

    // список moodboard'ів
    Route::get('/moodboards', [MoodboardController::class, 'index'])
        ->name('moodboards.index');

    // створення moodboard
    Route::get('/moodboards/create', [MoodboardController::class, 'create'])
        ->name('moodboards.create');

    Route::post('/moodboards', [MoodboardController::class, 'store'])
        ->name('moodboards.store');

    // показ конкретного moodboard
    Route::get('/moodboards/{moodboard}', [MoodboardController::class, 'show'])
        ->name('moodboards.show');

    // видалення moodboard
    Route::delete('/moodboards/{moodboard}', [MoodboardController::class, 'destroy'])
        ->name('moodboards.destroy');

    // додати товар зі сторінки товару
    Route::post('/moodboards/add/{product}', [MoodboardController::class, 'addFromProduct'])
        ->name('moodboards.addFromProduct');

    // видалити товар із moodboard
    Route::delete('/moodboards/{moodboard}/remove/{product}', [MoodboardController::class, 'removeProduct'])
        ->name('moodboards.removeProduct');
    
    Route::patch('/moodboards/{moodboard}/toggle', [MoodboardController::class, 'toggle'])
        ->name('moodboards.toggle');
});

// публічний перегляд moodboard через share_token
Route::get('/m/{token}', [MoodboardController::class, 'publicShow'])
    ->name('moodboards.public');
/*
|--------------------------------------------------------------------------
| Адмінські маршрути (CRUD категорій та товарів)
|--------------------------------------------------------------------------
|
| !!! ВАЖЛИВО !!!
| create/edit/update/delete ДЛЯ products мають бути ВИЩЕ, ніж show,
| інакше Laravel думає, що "create" — це ID товару → 404
|
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');

    // Категорії CRUD
    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    // Товари CRUD (адмінські дії)
    Route::resource('products', ProductController::class)
        ->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Публічний перегляд товару (має бути ОСТАННІМ)
|--------------------------------------------------------------------------
|
| ЦЕ ВАЖЛИВО: products/{product} має стояти ПІСЛЯ create/edit/delete,
| інакше "/products/create" буде сприйматись як ID товару.
|
*/

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');


/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
