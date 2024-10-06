<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\LicencesRBQ;
use App\Models\CodesUNSPSC;
use App\Models\Fourniseur_code_unspsc_liaison;
use App\Models\Fourniseur_licences_rbq_liaison;
use App\Models\Personne_ressource;
use App\Models\Telephone;
use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Demande;
use App\Models\Region_administrative;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = 10;

        return view('views.pageVoirFiche', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$id_fournisseur = Auth::user()->id;

        /*
        $fournisseur = Fournisseur::where('id_fournisseurs', $id)->first();
        Log::info($fournisseur);

        if (!$fournisseur) {
            abort(404); // Handle the case when the supplier is not found
        }*/

        $fournisseur = Fournisseur::with('region')->where('id_fournisseurs', $id)->first();
        Log::info($fournisseur);

        if (!$fournisseur) {
            abort(404); // Handle the case when the supplier is not found
        }

        return view('views.pageVoirFiche', compact('fournisseur'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
