<?php

namespace App\Policies;

use App\Models\{Post, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }

    public function update(Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }

    public function delete(Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }
}
