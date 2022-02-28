<?php

namespace App\Http\Controllers;

use App\Models\{Like, Post, User};
use App\Notifications\LikeNotifications;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $attr = [
            'post_id' => $post->id,
            'likes' => 1,
        ];

        $like = auth()->user()->likes()->create($attr);
        if ($post->user_id != $like->user_id) {
            $user = User::find($post->user_id);
            $user->notify(new LikeNotifications($like, $post));
        }

        return back();
    }
}
