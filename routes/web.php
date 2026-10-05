<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\PostController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

// Posts: semua user login boleh lihat. Tulis/edit/hapus hanya admin & editor.
// Ownership (editor hanya post miliknya) dijaga oleh PostPolicy.
Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
});

// Area admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard', [
        'stats' => [
            'Users' => User::count(),
            'Produk' => Product::count(),
            'Order' => Order::count(),
        ],
    ]))->name('dashboard');
});

// Area editor (admin juga boleh masuk)
Route::middleware(['auth', 'role:admin,editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/', fn () => view('editor.dashboard'))->name('dashboard');
});

require __DIR__.'/auth.php';
