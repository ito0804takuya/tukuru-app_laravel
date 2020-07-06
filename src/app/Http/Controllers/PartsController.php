<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;

class PartsController extends Controller
{
    public function index() {
        $parts = Part::with('supplier')
                ->with('createdUser')
                ->with('updatedUser')->get();
        return view('parts.index', ['parts' => $parts]);
    }
}
