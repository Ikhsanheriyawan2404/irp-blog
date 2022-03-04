<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, Like, Gallery};

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'post_most_viewed' => Post::with('user', 'likes', 'comments', 'categories')->withCount('likes')->orderBy('likes_count', 'DESC')->limit(5)->get(),
            'posts' => Post::with('user', 'likes', 'comments', 'categories')->latest()->simplePaginate(10),
            'categories' => Category::get(),
        ]);
    }

    public function search()
    {
        $query = request('query');
        return view('frontend.home', [
            'title' => 'Hasil untuk ' . $query,
            'post_most_viewed' => Post::with('user', 'likes', 'comments', 'categories')->withCount('likes')->orderBy('likes_count', 'DESC')->limit(5)->get(),
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
                'likes' => $likes,
                'post_related' => Post::whereHas('categories', function ($q) use ($post) {
                    return $q->whereIn('name', $post->categories->pluck('name'));
                })
                ->where('id', '!=', $post->id)
                ->limit(5)
                ->get(),
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
        return view('frontend.gallery', [
            'title' => 'Galeri Dokumentasi IRP',
            'galleries' => Gallery::latest()->paginate(9),
        ]);
    }
}
