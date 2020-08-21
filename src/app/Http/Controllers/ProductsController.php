<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('createdUser')
            ->with('updatedUser')
            ->where('products.name', 'like', '%' . $request->input('search_product_name') . '%')
            ->where('products.product_code', 'like', '%' . $request->input('search_product_code') . '%')
            ->whereHas('createdUser', function (Builder $query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->input('search_created_user_name') . '%');
            })
            ->when($request->input('search_updated_user_name'), function ($products) use ($request) {
                $products->whereHas('updatedUser', function (Builder $query) use ($request) {
                    $query->where('users.name', 'like', '%' . $request->input('search_updated_user_name') . '%');
                });
            })
            ->when($request->input('created_from') && $request->input('created_until'), function ($products) use ($request) {
                $products->whereBetween("products.created_at", [
                    $request->input('created_from'),
                    $request->input('created_until')
                ]);
            })
            ->when($request->input('updated_from') && $request->input('updated_until'), function ($products) use ($request) {
                $products->whereBetween("products.updated_at", [
                    $request->input('updated_from'),
                    $request->input('updated_until')
                ]);
            })
            ->orderBy('products.updated_at', 'desc')
            ->paginate(10);

        return view('home', [
            'products' => $products,
            'request' => $request->all()
        ]);
    }

    public function create()
    {
        $parts = DB::table('parts')->get();
        return view('products.create', ['parts' => $parts]);
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;
        $image = $request->file('image');
        if(app()->isLocal()) {
            $filename = $image->store('public/images');
            $product->fill([
                'image' => Storage::url($filename)
            ]);
        } else {
            $filename = Storage::disk('s3')->put('/', $image, 'public');
            $product->fill([
                'image' => Storage::disk('s3')->url($filename)
            ]);
        }
        $result = $product->fill([
            'name' => $request->name,
            'product_code' => $request->product_code,
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
        return view('products.show', [
            'product' => $product,
            'parts' => $parts
        ]);
    }

    public function edit($id)
    {
        $product = Product::with(['createdUser', 'updatedUser'])->find($id);
        $parts = DB::table('parts')->get();
        $partsIds = $product->parts->pluck('id')->toArray();
        return view('products.edit', [
            'product' => $product,
            'parts' => $parts,
            'partsIds' => $partsIds
        ]);
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
