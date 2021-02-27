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
    public function index()
    {
        return view('frontend.home', [
            'title' => 'Halaman Utama',
            'posts' => Post::with('user', 'likes', 'comments', 'categories')->paginate(5),
            'categories' => Category::get(),
        ]);
    }

    public function search()
    {
        $query = request('query');
        return view('frontend.home', [
            'title' => 'Hasil untuk ' . $query,
            'posts' => Post::where("title", "like", "%$query%")->latest()->paginate(5),
            'categories' => Category::get(),
        ]);
    }

    public function show_post(Post $post)
    {
        $likes = Like::where('post_id', $post->id)->get();
        if ($post) {
            return view('frontend.post', [
                'title' => $post->title,
                'post' => $post,
                'posts' => Post::with('user', 'categories')->limit(5)->get(),
                'likes' => $likes,
            ]);
        } else {
            abort(404);
        }
    }

    public function show_category(Category $category)
    {
        $posts = $category->posts()->with('user', 'likes', 'comments')->latest()->paginate(5);
        return view('frontend.category', [
            'title' => 'Kategori Postingan',
            'category' => $category,
            'posts' => $posts,
            'categories' => Category::get(),
        ]);
    }

    public function about_us()
    {
        return view('frontend.about_us',[
            'title' => 'Tentang Kami',
        ]);
    }

    public function gallery()
    {
        return view('frontend.gallery',[
            'title' => 'Galleri Dokumentasi IRP',
        ]);
    }
}
