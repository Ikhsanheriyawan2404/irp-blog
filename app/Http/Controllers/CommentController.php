<?php

namespace App\Http\Controllers;

use App\Models\{Comment, Post};
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function store($id)
    {
        request()->validate([
            'comment' => 'required',
        ]);

        $post = Post::find($id);
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'message' => request('comment'),
        ]);

        return back();
    }

    public function edit($id)
    {
        $comment = Comment::where('id', $id)->first();
        return \Response::json($comment);
    }

    public function update(Comment $comment)
    {
        request()->validate([
            'comment' => 'required',
        ]);

        $post = Post::find($id);
        $comment->update([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'message' => request('comment'),
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
