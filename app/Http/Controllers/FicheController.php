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
     * Liste les ressources 
     */
    public function index()
    {
        $id = 10;

        return view('views.pageVoirFiche', ['id' => $id]);
    }

    /**
     * Cherche une source specifique
     */
    public function show(string $id)
    {
        $fournisseur = Fournisseur::with('region')->where('id_fournisseurs', $id)->first();
        //Log::info($fournisseur);

        if (!$fournisseur) {
            abort(404); // Handle the case when the supplier is not found
        }

        return view('views.pageVoirFiche', compact('fournisseur'));
        
    }
}
