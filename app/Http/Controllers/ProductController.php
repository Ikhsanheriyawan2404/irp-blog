<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function search()
    {
        $query = request('query');
        return view('frontend.product', [
            'title' => 'Hasil dari' . $query,
            'products' => Product::where("name", "like", "%$query%")->latest()->paginate(9),
            'shops' => Shop::all(),
        ]);
    }

    public function filter()
    {
        request()->validate(['filter' => 'required']);
        $query = request('filter');
        return view('frontend.product', [
            'title' => 'Hasil dari' . $query,
            'products' => Product::where('shop_id', $query)->latest()->paginate(9),
            'shops' => Shop::all(),
        ]);
    }

    public function frontend()
    {
        return view('frontend.product', [
            'title' => 'Product',
            'products' => Product::latest()->paginate(9),
            'shops' => Shop::all(),
        ]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('shop', function (Product $product) {
                    return $product->shop->name;
                })
                ->addColumn('image', function($request) {
                    return "<img src='$request->takeImage' class='img-fluid' />";
                })
                ->addColumn('action', function($row) {
                    $btn = '<div class="d-flex justify-content-center">
                    <a href="' . route('product.edit', $row->id) . '" class="btn btn-success btn-sm mr-2"><i class="fas fa-pencil-alt"></i></a>
                        <form action="' . route('product.destroy', $row->id) . '" method="post">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                            <button type="submit" data-id="'.$row->id.'" class="btn btn-danger btn-sm" id="deleteItem" onclick="return confirm(\'Are you sure want to delete this?\')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('backend.products.index', [
            'title' => 'Product Admin',
        ]);
    }

    public function create()
    {
        return view('backend.products.create', [
            'title' => 'Add Product',
            'product' => new Product(),
            'shops' => Shop::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255',
            'price' => 'required|int',
            'discount' => 'required|int',
            'image' => 'required|image|max:2058',
            'shop_id' => 'required',
        ]);

        Product::create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'discount' => request('discount'),
            'image' => request()->file('image')->store('img/products'),
            'shop_id' => request('shop_id'),
        ]);

        return redirect()->route('product.index')->with('success', 'Data was created!');
    }

    public function edit(Product $product)
    {
        return view('backend.products.edit', [
            'title' => 'Edit Product',
            'product' => $product,
            'shops' => Shop::all(),
        ]);
    }

    public function update(Product $product)
    {
        if (request('image')) {
            $image = request()->file('image')->store('img/products');
        } else {
            $image = $product->image;
        }

        request()->validate([
            'name' => 'required|max:255',
            'price' => 'required|int',
            'discount' => 'required|int',
            'shop_id' => 'required',
        ]);

        $product->update([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'discount' => request('discount'),
            'image' => $image,
            'shop_id' => request('shop_id'),
        ]);

        return redirect()->route('product.index')->with('success', 'Data was deleted!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Storage::delete($product->image);
        return redirect()->back()->with('success', 'Data was deleted!');
    }
}
