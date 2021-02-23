<?php

namespace App\Http\Controllers;

use App\Models\{User, Post};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        return view('frontend.users.index', [
            'title' => 'Halaman User',
            'user' => User::findOrFail($id),
            'posts' => Post::latest()->paginate(5),
        ]);
    }

    public function edit(User $user, $id)
    {
        return view('frontend.users.edit', [
            'title' => 'Edit User',
            'user' => User::findOrFail($id),
        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $user->update([
            'name' => request('name'),
            'image' => request('image'),
            'bio' => request('bio'),
            'gender' => request('gender'),
            'date_of_birth' => request('date_of_birth'),
            'password' => request('password'),
        ]);

        return redirect()->route('user.show')->with('success', 'Profil berhasil diubah')
    }

    public function destroy(User $user)
    {

    }
}
