<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, User, Gallery};

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.index', [
            'title' => 'Halaman Admin',
            'posts' => Post::all(),
            'categories' => Category::all(),
            'users' => User::all(),
            'galleries' => Gallery::all(),
        ]);
    }
}
