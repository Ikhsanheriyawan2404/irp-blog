<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Gallery::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($request) {
                    return "<img src=$request->takeImage />";
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem"><i class="fas fa-trash"></i></a>';
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
        Storage::delete($gallery->image);
        $gallery->delete();
        return back()->with('succes', 'Image was deleted');
    }
}
