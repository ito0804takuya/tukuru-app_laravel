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

    public function create()
    {
        $parts = DB::table('parts')->get();
        return view('products.create', ['parts' => $parts]);
    }

    public function show($id)
    {
        $product = Product::with(['createdUser', 'updatedUser'])->find($id);
        $parts = $product->parts()->get();
        return view('products.show', ['product' => $product, 'parts' => $parts]);
    }

    public function edit($id)
    {
        $product = Product::with(['createdUser', 'updatedUser'])->find($id);
        $parts = DB::table('parts')->get();
        $partsIds = $product->parts->pluck('id')->toArray();
        return view('products.edit', ['product' => $product, 'parts' => $parts, 'partsIds' => $partsIds]);
    }
}
