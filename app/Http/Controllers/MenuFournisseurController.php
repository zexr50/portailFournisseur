<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MenuFournisseurController extends Controller
{
    public function index(Request $request)
    {
        $id_fournisseur = Auth::user()->id_fournisseurs;

        $demandefournisseur = DB::table('demandesfournisseurs')->where('id_fournisseurs', $id_fournisseur)->first();

        return view('views.pageMenuFournisseur', compact('demandefournisseur'));
        
    }
}
