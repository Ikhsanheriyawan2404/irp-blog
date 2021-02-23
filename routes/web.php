<?php

use App\Http\Controllers\{HomeController, UserController};
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
Route::get('/{slug}', [HomeController::class, 'show'])->name('posts.index');
Route::get('/tentang-kami', [HomeController::class, 'about_us'])->name('about_us');
Route::middleware('auth')->group(function () {
    Route::prefix('users')->group(function() {
        Route::get('{id}', [UserController::class, 'show'])->name('users.index');
        Route::get('{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('{slug}/edit', [PostController::class, 'update'])->name('posts.update');
    });
    Route::prefix('posts')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('posts.create');
        Route::post('store', [PostController::class, 'store'])->name('posts.store');
        Route::get('{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('{slug}/edit', [PostController::class, 'update'])->name('posts.update');
        Route::delete('{slug}/delete', [PostController::class, 'destroy'])->name('posts.delete');
    });
});
