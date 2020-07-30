<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('createdUser')
            ->with('updatedUser')->get();
        return view('home', ['products' => $products]);
    }

    public function create()
    {
        $parts = DB::table('parts')->get();
        return view('products.create', ['parts' => $parts]);
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;
        $filename = $request->image->store('public/images');
        $result = $product->fill([
            'name' => $request->name,
            'product_code' => $request->product_code,
            'image' => basename($filename),
            'created_user_id' => Auth::id(),
            'updated_user_id' => null
        ])->save();
        if ($result) {
            $product->parts()->attach($request->parts);
        }
        return redirect('/');
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

    public function update(ProductRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $product = Product::find($id);
            if ($request->image) {
                $filename = $request->image->store('public/images');
                $product->fill([
                    'image' => basename($filename)
                ]);
            }
            $result = $product->fill([
                'name' => $request->name,
                'product_code' => $request->product_code,
                'updated_user_id' => Auth::id()
            ])->save();
            if ($result) {
                $product->parts()->detach();
                $product->parts()->attach($request->parts);
            }
        });
        return redirect('/');
    }

    public function destroy($id)
    {
        $product = Product::with(['parts'])->find($id);
        $product->parts()->detach();
        $product->delete();
        return redirect('/');
    }
}
