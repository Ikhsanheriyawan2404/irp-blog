<?php

namespace App\Http\Controllers;

use App\Models\{Like, Post};
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($id)
    {
        request()->validate([
            'likes' => 'required',
        ]);

        $post = Post::find($id);
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'likes' => 1,
        ]);

        return back();
    }
}
