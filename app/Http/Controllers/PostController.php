<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;


class PostController extends Controller
{
    /**
     * @return json
     * Data ditampilkan dengan datatables serverside
     */
    public function index(Post $post)
    {
        if (request()->ajax()) {
            $data = Post::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users', function (Post $post) {
                    return $post->user->name;
                })
                ->editColumn('created_at', function($request) {
                    return $request->created_at->diffForHumans();
                })
                ->addColumn('action', function($row) {
                    $btn = '<div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-info btn-sm mr-2" id="showItem"><i class="fas fa-eye"></i></a>
                        <form action="' . route('post.delete', $row->slug) . '" method="post">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                            <button type="submit" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem" onclick="return confirm(\'Are you sure want to delete this?\')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>';
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

    public function create()
    {
        return view('frontend.posts.create', [
            'title' => 'Buat Postingan',
            'post' => new Post,
            'categories' => Category::all(),
        ]);
    }

    public function store()
    {
        // Validasi inputan dari user untuk simpan post
        request()->validate([
            'title' => 'required|min:8|max:255|unique:posts,title,',
            'category' => 'required|array',
            'body' => 'required|min:50',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2058',
        ]);

        // Inputan dari user
        $attr = [
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'meta_title' => request('title'),
            'meta_description' => request('meta_description'),
            'meta_keyword' => request('meta_keyword'),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('img/post') : null,
            'body' => request('body'),
        ];

        // Menyimpan author post
        $post = auth()->user()->posts()->create($attr);
        // Menyimpan kategori post
        $post->categories()->sync(request('category'));

        // Menampilkan report success
        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan baru berhasil ditambahkan');
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function edit(Post $post)
    {
        return view('frontend.posts.edit', [
            'title' => 'Edit Postingan',
            'post' => $post,
            'categories' => Category::get(),
        ]);
    }

    public function update(Post $post)
    {
        // Permission untuk user lain tidak bisa akses
        $this->authorize('update', $post);

        request()->validate([
            'title' => 'required|min:8|unique:posts,title,' . $post->id,
            'category' => 'required|array',
            'body' => 'required|min:50',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2058',
        ]);

        // Pengkodisian upload gambar
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
        // Permission untuk user lain tidak bisa akses
        $this->authorize('delete', $post);

        // Hapus data kategori post di tabel category_post
        $post->categories()->detach();

        // Hapus gambar
        Storage::delete($post->thumbnail);
        // Hapus data post
        $post->delete();

        return redirect()->route('user.show', $post->user->id)->with('success', 'Postingan berhasil dihapus');
    }
}
