<?php

namespace App\Policies;

use App\Models\{User, Comment};
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        return $comment->user_id === auth()->user()->id;
    }
}
