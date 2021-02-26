<?php

namespace App\Http\Controllers;

use App\Models\{User, Post, Like};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function show(User $user)
    {
        if ($user) {
            return view('frontend.users.index', [
                'title' => 'Halaman User',
                'user' => $user,
                'posts' => Post::latest()->where('user_id', $user->id)->paginate(5),
                'likes' => Like::where('user_id', $user->id),
            ]);
        } else {
            abort(404);
        }
    }

    public function edit(User $user)
    {
        return view('frontend.users.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $this->authorize('update', $user);
        if (request('image')) {
            Storage::delete($user->image);
            $image = request()->file('image')->store('img/profile');
        } elseif ($user->image) {
            $image = $user->image;
        } else {
            $image = null;
        }

        request()->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $user->update([
            'name' => request('name'),
            'image' => $image,
            'bio' => request('bio'),
            'gender' => request('gender'),
            'date_of_birth' => request('date_of_birth'),
        ]);

        return redirect()->route('user.show', $user->id)->with('success', 'Profil berhasil diedit');
    }
}
