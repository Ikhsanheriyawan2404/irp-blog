<?php

use App\Http\Controllers\{HomeController, PostController, CategoryController, UserController, CommentController};
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('{post:slug}', [HomeController::class, 'show_post'])->name('post');
Route::get('category/{category:slug}', [HomeController::class, 'show_category'])->name('category');
Route::get('info/tentang-kami', [HomeController::class, 'about_us'])->name('about_us');
Route::get('info/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('{user:id}', [UserController::class, 'show'])->name('user.show');
        Route::get('{user:id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{user:id}/edit', [UserController::class, 'update'])->name('user.update');
    });
    Route::prefix('comment')->group(function() {
        Route::post('{post:id}', [CommentController::class, 'store'])->name('comment.store');
        Route::get('{post:id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
        Route::put('{post:id}/edit', [CommentController::class, 'update'])->name('comment.update');
        Route::delete('{post:id}/edit', [CommentController::class, 'destroy'])->name('comment.delete');
    });
    Route::prefix('post')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('{post:slug}/edit', [PostController::class, 'update'])->name('post.update');
        Route::delete('{post:slug}/delete', [PostController::class, 'destroy'])->name('post.delete');
    });
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('category')->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('admin.index');
                Route::resource('category', CategoryController::class);
            });
        });
    });
});
