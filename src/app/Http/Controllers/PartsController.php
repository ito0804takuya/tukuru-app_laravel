<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;
use Illuminate\Support\Facades\DB;

class PartsController extends Controller
{
    public function index() {
        $parts = Part::with('supplier')
                ->with('createdUser')
                ->with('updatedUser')->get();
        return view('parts.index', ['parts' => $parts]);
    }

    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('parts.create', ['suppliers' => $suppliers]);
    }
    
    public function show($id) {
        $part = Part::find($id)
                ->with('createdUser')
                ->with('updatedUser')->first();
        $products = $part->products()->get();
        return view('parts.show', ['part' => $part, 'products' => $products]);
    }
}
