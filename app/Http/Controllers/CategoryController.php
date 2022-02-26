<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        if (request()->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm mr-2" id="editItem"><i class="fas fa-pencil-alt"></i></a>
                        <form action="' . route('category.destroy', $row->id) . '" method="post">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                            <button type="submit" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem" onclick="return confirm(\'Are you sure want to delete this?\')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.categories.index', [
            'title' => 'Categories Page',
            'category' => $category,
        ]);
    }

    public function store()
    {
        Category::updateOrCreate(['id' => request('category_id')],
            ['name' => request('name'), 'slug' => Str::slug(request('name'))]);

        return back()->with('success', 'Data was created!');
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Data was deleted.');
    }
}
