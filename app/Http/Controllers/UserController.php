<?php

namespace App\Http\Controllers;

use App\Models\{User, Post};
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        return view('frontend.users.index', [
            'title' => 'Halaman User',
            'user' => User::findOrFail($id),
            'posts' => Post::latest()->paginate(5),
            'likes' => Post::select('like')->findOrFail($id)->count(),
        ]);
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

        return redirect()->route('user.show', $user->id)->with('success', 'Profil berhasil diubah');
    }
}
