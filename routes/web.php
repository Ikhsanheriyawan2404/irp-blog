<?php

use App\Http\Controllers\{HomeController, PostController, CategoryController, UserController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', HomeController::class)->name('home');
Route::get('/{slug}', [HomeController::class, 'show'])->name('post.index');
Route::get('/tentang-kami', [HomeController::class, 'about_us'])->name('about_us');
Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('{id}', [UserController::class, 'show'])->name('user.index');
        Route::get('{slug}/edit', [PostController::class, 'edit'])->name('user.edit');
        Route::put('{slug}/edit', [PostController::class, 'update'])->name('user.update');
    });
    Route::prefix('post')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{slug}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('{slug}/edit', [PostController::class, 'update'])->name('post.update');
        Route::delete('{slug}/delete', [PostController::class, 'destroy'])->name('post.delete');
    });
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('category')->group(function () {
                Route::resources('category', CategoryController::class);
            });
        });
    });
});
