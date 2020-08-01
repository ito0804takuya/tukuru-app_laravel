<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;
use App\Part;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PartsController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = DB::table('suppliers')->get();

        $parts = Part::with('supplier')
            ->with('createdUser')
            ->with('updatedUser')
            ->where('parts.name', 'like', '%'.$request->input('search_part_name').'%')
            ->when($request->input('search_supplier_id'), function($parts) use ($request) {
                $parts->whereHas('supplier', function (Builder $query) use ($request) {
                    $query->where('id', $request->input('search_supplier_id'));
                });
            })
            ->whereHas('createdUser', function (Builder $query) use ($request) {
                $query->where('users.name', 'like', '%'.$request->input('search_created_user_name').'%');
            })
            ->when($request->input('search_updated_user_name'), function($parts) use ($request) {
                $parts->whereHas('updatedUser', function (Builder $query) use ($request) {
                    $query->where('users.name', 'like', '%'.$request->input('search_updated_user_name').'%');
                });
            })
            ->when($request->input('created_from') && $request->input('created_until') , function($parts) use ($request) {
                $parts->whereBetween("parts.created_at", [
                    $request->input('created_from'), 
                    $request->input('created_until')
                ]);
            })
            ->when($request->input('updated_from') && $request->input('updated_until') , function($parts) use ($request) {
                $parts->whereBetween("parts.updated_at", [
                    $request->input('updated_from'), 
                    $request->input('updated_until')
                ]);
            });
        
        return view('parts.index', [
            'parts' => $parts->get(), 
            'suppliers' => $suppliers,
            'request' => $request->all()
        ]);
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

    public function show($id)
    {
        $part = Part::with(['createdUser', 'updatedUser'])->find($id);
        $products = $part->products()->get();
        return view('parts.show', [
            'part' => $part, 
            'products' => $products
        ]);
    }

    public function edit($id)
    {
        $part = Part::with('supplier')->find($id);
        $suppliers = DB::table('suppliers')->get();
        return view('parts.edit', [
            'part' => $part, 
            'suppliers' => $suppliers
        ]);
    }

    public function update(PartRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $part = Part::find($id);
            $part->fill([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'updated_user_id' => Auth::id()
            ])->save();
        });
        return redirect(route('parts.show', ['part' => $id]));
    }

    public function destroy(Part $part)
    {
        // この部品を使用している商品が存在しない場合、削除できる
        if (!$part->products()->count() >= 1) {
            $part->delete();
            return redirect('/parts');
        }
        return redirect('/parts');
    }
}
