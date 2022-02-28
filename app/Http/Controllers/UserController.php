<?php

namespace App\Http\Controllers;

use App\Models\{User, Post, Like};
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function($request) {
                    return $request->created_at->diffForHumans();
                })
                ->addColumn('role', function($row) {
                    $btnUser = '<form action="' . route('users.role', $row->id) . '" method="post">
                    '. csrf_field() .'
                    <input type="hidden" value="admin" name="role">
                    <button type="submit" class="btn btn-primary btn-sm">User</button>
                    </form>';
                    $btnAdmin = '<form action="' . route('users.role', $row->id) . '" method="post">
                    '. csrf_field() .'
                    <input type="hidden" value="user" name="role">
                    <button type=submit class="btn btn-primary btn-sm">Admin</button>
                    </form>';
                    if ($row->role == 'admin') {
                        return $btnAdmin;
                    } else {
                        return $btnUser;
                    }
                })
                ->addColumn('action', function($row) {
                    $btn = '<form action="' . route('user.destroy', $row->id) . '" method="post">
                    '. csrf_field() .'
                    '. method_field('DELETE') .'
                    <button type="submit" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem" onclick="return confirm(\'Are you sure want delete this data?\')"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }

        return view('backend.users.index', [
            'title' => 'Users Page',
        ]);
    }
    public function show(User $user)
    {
        // Pengkodisian jika user tidak ada halaman tidak ditampilkan
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
        // User tidak bisa mengedit data user lainnya
        if ($user->id === auth()->user()->id) {
            return view('frontend.users.edit', [
                'title' => 'Edit User',
                'user' => $user,
            ]);
        } else {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    public function update(User $user)
    {
        // Logika gambar default tidak terhapus ketika update data user
        if (request('image')) {
            if ($user->image == 'img/profile/irp-logo.png') {
                $image = request()->file('image')->store('img/profile');
            } else {
                Storage::delete($user->image);
                $image = request()->file('image')->store('img/profile');
            }
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

        if ($user->id === auth()->user()->id) {
                $user->update([
                'name' => request('name'),
                'image' => $image,
                'bio' => request('bio'),
                'gender' => request('gender'),
                'date_of_birth' => request('date_of_birth'),
            ]);
        } else {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        return redirect()->route('user.show', $user->id)->with('success', 'Profil berhasil diedit');
    }

    public function destroy(User $user)
    {
        // Pencegahan penghapusan gambar avatar default
        if ($user->image !== 'img/profile/irp-logo.png') {
            Storage::delete($user->image);
        }

        $user->delete();
        return back()->with('success', 'Data user was deleted!');
    }

    public function changeRole(User $user)
    {
        $user->update([
            'role' => request('role'),
        ]);

        return back()->with('success', 'Role user was changed!');
    }
}
