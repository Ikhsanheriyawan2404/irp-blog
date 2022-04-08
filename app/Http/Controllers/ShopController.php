<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Yajra\Datatables\Datatables;

class ShopController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Shop::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm mr-2" id="editItem"><i class="fas fa-pencil-alt"></i></a>
                        <form action="' . route('shop.destroy', $row->id) . '" method="post">
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

        return view('backend.shops.index', [
            'title' => 'Shop Page',
        ]);
    }

    public function store()
    {
        Shop::updateOrCreate(['id' => request('shop_id')],
            ['name' => request('name'), 'number' => request('number')]);

        return back()->with('success', 'Data was created!');
    }

    public function edit(Shop $shop)
    {
        return response()->json($shop);
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return back()->with('success', 'Data was deleted.');
    }
}
