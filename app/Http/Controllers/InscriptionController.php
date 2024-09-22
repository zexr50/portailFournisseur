<?php

namespace App\Http\Controllers;
use App\Models\LicencesRBQ;
use Illuminate\Http\Request;


class InscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = LicencesRBQ::query();
    
        if ($request->has('search')) {
            $query->where('sous_categorie', 'like', '%' . $request->search . '%');
        }
    
        $licences_rbqs = $query->paginate(100);
        return view('licences_rbq.index', compact('licences_rbqs'));
    }

}
