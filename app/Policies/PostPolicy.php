<?php

namespace App\Policies;

use App\Models\{Post, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Post $postt)
    {
        return $user->id === $post->user_id;
    }

    public function update(User $user, Post $postt)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $postt)
    {
        return $user->id === $post->user_id;
    }
}
