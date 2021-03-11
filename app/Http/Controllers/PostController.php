<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        if (request()->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users', function (Post $post) {
                    return $post->user->name;
                })
                ->editColumn('created_at', function($request) {
                    return $request->created_at->diffForHumans();
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-info btn-sm" id="showItem"><i class="fas fa-eye"></i></a>
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.posts.index', [
            'title' => 'Posts Page',
            'post' => $post,
        ]);
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
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2058',
        ]);

        $attr = [
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'meta_title' => request('title'),
            'meta_description' => request('meta_description'),
            'meta_keyword' => request('meta_keyword'),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('img/post') : null,
            'body' => request('body'),
        ];

        $post = auth()->user()->posts()->create($attr);
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
        return response()->json($post);
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
        $this->authorize('update', $post);

        request()->validate([
            'title' => 'required|min:8|unique:posts,title,' . $post->id,
            'category' => 'required|array',
            'body' => 'required|min:50',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2058',
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
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan berhasil diedit');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->categories()->detach();
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan berhasil dihapus');
    }
}
