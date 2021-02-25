<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.posts.create', [
            'title' => 'Buat Postingan',
            'post' => new Post,
            'categories' => Category::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'title' => 'required|min:8|unique:posts,title,',
            'category' => 'required|array',
            'body' => 'required|min:50',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'meta_title' => request('title'),
            'meta_description' => request('meta_description'),
            'meta_keyword' => request('meta_keyword'),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('img/post') : null,
            'body' => request('body'),
        ]);

        $post->categories()->sync(request('category'));
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('frontend.posts.edit', [
            'title' => 'Edit Postingan',
            'post' => $post,
            'categories' => Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required|min:8|unique:posts,title,' . $post->id,
            'category' => 'required|array',
            'body' => 'required|min:50',
        ]);

        if (request('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('img/post');
        } elseif ($post->thumbnail) {
            $thumbnail = $post->thumbnail;
        } else {
            $thumbnail = null;
        }

        $post->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'meta_title' => request('title'),
            'meta_description' => request('meta_description'),
            'meta_keyword' => request('meta_keyword'),
            'thumbnail' => $thumbnail,
            'body' => request('body'),
        ]);

        $post->categories()->sync(request('category'));
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan baru berhasil ditambahkan');
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach();
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan berhasil dihapus');
    }
}
