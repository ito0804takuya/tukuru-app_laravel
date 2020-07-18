<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;
use App\Part;
use Illuminate\Support\Facades\Auth;
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

    public function store(PartRequest $request)
    {
        $part = new Part;
        $part->fill([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'created_user_id' => Auth::id(),
            'updated_user_id' => null
        ])->save();
        return redirect('/parts');
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
