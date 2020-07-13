<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;
use Illuminate\Support\Facades\DB;

class PartsController extends Controller
{
    public function index()
    {
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

    public function show(int $id)
    {
        $part = Part::with(['createdUser', 'updatedUser'])->find($id);
        $products = $part->products()->get();
        return view('parts.show', ['part' => $part, 'products' => $products]);
    }

    public function edit($id)
    {
        $part = Part::with('supplier')->find($id);
        $suppliers = DB::table('suppliers')->get();
        return view('parts.edit', ['part' => $part, 'suppliers' => $suppliers]);
    }
}
