<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProductsController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('home');
        }
        return redirect('/login');
    }
}
