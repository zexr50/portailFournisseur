<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LicencesRBQController extends Controller
{
    public function index(Request $request)
    {
        $query = licences_rbq::query();
    
        if ($request->has('search')) {
            $query->where('sous_categorie', 'like', '%' . $request->search . '%');
        }
    
        $licences_rbqs = $query->paginate(100);
        return view('licences_rbq.index', compact('licences_rbqs'));
    }
}
