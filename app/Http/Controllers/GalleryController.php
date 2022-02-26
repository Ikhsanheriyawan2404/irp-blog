<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Gallery::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($request) {
                    return "<img src='$request->takeImage' class='img-fluid' />";
                })
                ->addColumn('action', function($row) {
                    $btn = '<form action="' . route('gallery.destroy', $row->id) . '" method="post">
                    '. csrf_field() .'
                    '. method_field('DELETE') .'
                    <button type="submit" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem" onclick="return confirm(\'Are you sure want delete this data?\')">Delete <i class="fas fa-trash-alt"></i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('backend.galleries.index', [
            'title' => 'Galleries Page',
        ]);
    }

    public function create()
    {
        return view('backend.galleries.create', [
            'title' => 'Add Image',
        ]);
    }

    public function store()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2058',
            'caption' => 'required',
        ]);

        $imageName = date('dmY', time()) . '-' . request('image')->getClientOriginalName();
        Gallery::create([
            'image' => request()->file('image')->storeAs('img/gallery', $imageName),
            'caption' => request('caption'),
        ]);

        return back()->with('success', 'Data successfull added!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        Storage::delete($gallery->image);
        return back()->with('success', 'Image was deleted');
    }
}
