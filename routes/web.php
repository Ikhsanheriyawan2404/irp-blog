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

Route::get('/', HomeController::class, 'index')->name('home');
Route::middleware('auth')->group(function () {
    Route::prefix('users')->group(function() {
        Route::get('{users:id}', [UserController::class])->name('users.index');
    });
});
