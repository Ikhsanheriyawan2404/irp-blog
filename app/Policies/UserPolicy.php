<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        // nggk guna asyuuu, ngebug
        return $user->id === auth()->user()->id;
    }
}
