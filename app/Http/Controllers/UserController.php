<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return view('frontend.users.index', [
            'user' => User::get(),
            'title' => 'Halaman Profil',
        ]);    }
}
