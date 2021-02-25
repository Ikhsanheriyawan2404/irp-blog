<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, User, Like, Comment};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Post $post)
    {
        return view('frontend.home', [
            'title' => 'Halaman Utama',
            'posts' => Post::latest()->paginate(5),
            'categories' => Category::get(),
            'users' => User::get(),
            'likes' => Like::get(),
        ]);
    }

    public function show_post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            return view('frontend.post', [
                'title' => 'Read Article',
                'posts' => Post::latest()->paginate(5),
                'post' => $post,
                'category' => Category::first(),
                // 'comments' => Comment::
            ]);
        } else {
            abort(404);
        }
    }

    public function show_category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('frontend.category', [
            'title' => 'Category Article',
            'category' => $category,
            'categories' => Category::get(),
            'posts' => $category->posts()->latest(),
            'users' => User::get(),
        ]);
    }

    public function about_us()
    {
        return view([
            'title' => 'Tentang Kami',
        ]);
    }
}
