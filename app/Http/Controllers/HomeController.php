<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, User};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('home', [
            'title' => 'Halaman Utama',
            'posts' => Post::latest()->paginate(5),
            'categories' => Category::get(),
            'user' => User::get(),
        ]);
    }
}
