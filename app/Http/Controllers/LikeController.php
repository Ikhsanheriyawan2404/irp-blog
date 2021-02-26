<?php

namespace App\Http\Controllers;

use App\Models\{Like, Post};

class LikeController extends Controller
{
    public function store($id)
    {
        $post = Post::find($id);
        $attr = [
            'post_id' => $post->id,
            'likes' => 1,
        ];
        auth()->user()->likes()->create($attr);
        return back();
    }
}
