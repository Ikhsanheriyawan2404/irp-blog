<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.product', [
            'title' => 'Produk Kita',
        ]);
    }

    public function table()
    {
        return view('backend.products.index', [
            'title' => 'Data Product',
        ]);
    }
}
