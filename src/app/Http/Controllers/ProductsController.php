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
}
