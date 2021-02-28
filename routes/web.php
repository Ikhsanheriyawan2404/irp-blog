<?php

use App\Http\Controllers\{HomeController, PostController, CategoryController, UserController, CommentController, LikeController, AdminController};
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('post.search');
Route::get('{post:slug}', [HomeController::class, 'show_post'])->name('post');
Route::get('category/{category:slug}', [HomeController::class, 'show_category'])->name('category');
Route::get('info/tentang-kami', [HomeController::class, 'about_us'])->name('about_us');
Route::get('info/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('{user:id}', [UserController::class, 'show'])->name('user.show');
        Route::get('{user:id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{user:id}/edit', [UserController::class, 'update'])->name('user.update');
    });
    Route::prefix('comment')->group(function () {
        Route::post('{post:id}', [CommentController::class, 'store'])->name('comment.store');
        Route::delete('{comment:id}/delete', [CommentController::class, 'destroy'])->name('comment.delete');
    });
    Route::prefix('like')->group(function () {
        Route::post('{post:id}/create', [LikeController::class, 'store'])->name('post.like');
        // Route::put('{like:id}/update', [LikeController::class, 'update'])->name('post.unlike');
    });
    Route::prefix('post')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('{post:slug}/edit', [PostController::class, 'update'])->name('post.update');
        Route::delete('{post:slug}/delete', [PostController::class, 'destroy'])->name('post.delete');
    });
    // Route::middleware('user:role' => 'admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            Route::resource('category', CategoryController::class);
            Route::prefix('post')->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('post.index');
                Route::delete('{post:id}/delete', [PostController::class, 'destroy'])->name('post.delete');
            });
            Route::prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('user.index');
                Route::delete('{users:id}/delete', [UserController::class, 'destroy'])->name('user.delete');
            });
        });
    // });
});
