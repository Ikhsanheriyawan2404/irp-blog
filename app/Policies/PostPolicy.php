<?php

namespace App\Policies;

use App\Models\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }

    public function update(User $user, Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return auth()->user()->id === $post->user_id;
    }
}
