<?php

namespace App\Http\Controllers;

use App\Models\{Comment, Post, User};
use App\Notifications\CommentNotifications;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
            'comment' => 'required',
        ]);

        $attr = [
            'post_id' => $post->id,
            'message' => request('comment'),
        ];

        $comment = auth()->user()->comments()->create($attr);
        if ($post->user_id != $comment->user_id) {
            $user = User::find($post->user_id);
            $user->notify(new CommentNotifications($comment, $post));
        }
        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('post', $comment->post->slug);
    }
}
