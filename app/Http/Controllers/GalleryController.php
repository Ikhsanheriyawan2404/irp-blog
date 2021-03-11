<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Gallery::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
            'image' => 'image|mimes:jpg,jpeg,png|max:2058|required',
            'caption' => 'required',
        ]);

        Gallery::create([
            'image' => request('image'),
            'caption' => request('caption'),
        ]);

        return back()->with('success', 'Data successfull added!');
    }
}
