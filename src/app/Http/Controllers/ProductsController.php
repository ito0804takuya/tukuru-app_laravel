<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $products = Product::with('createdUser')
                ->with('updatedUser')->get();
            return view('home', ['products' => $products]);
        }
        return redirect('/login');
    }

    public function create() {
        $parts = DB::table('parts')->get();
        return view('products.create', ['parts' => $parts]);
    }

    public function show($id) {
        $product = Product::find($id)
                ->with('createdUser')
                ->with('updatedUser')->get();
        return view('products.show', ['product' => $product]);
    }
}
