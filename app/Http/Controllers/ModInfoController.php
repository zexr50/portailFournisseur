<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSingleFieldRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fournisseur;
use App\Models\Telephone;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ModInfoController extends Controller
{
    
    public function index()
    {
        $id_fournisseur =  Auth::user()->id_fournisseurs;
        $fournisseur = Fournisseur::with([
            'region',
            'telephones',
            'personne_ressources.telephones',
            'demande'
        ])->where('id_fournisseurs', $id_fournisseur)
        ->first();

        if (!$fournisseur) {
            abort(404); 
        }

        $phonesWithoutContact = Telephone::whereNotIn('id_telephone', $fournisseur->personne_ressources->pluck('id_telephone'))
            ->where('id_fournisseurs', $id_fournisseur)
            ->get();

        $licences = DB::table('licences_rbq')
            ->join('fournisseur_licence_rbq_liaison', 'licences_rbq.id_licence_rbq', '=', 'fournisseur_licence_rbq_liaison.id_licence_rbq')
            ->where('fournisseur_licence_rbq_liaison.id_fournisseurs', $id_fournisseur)
            ->get();

        $codes = DB::table('code_unspsc')
            ->join('fournisseur_code_unspsc_liaison', 'code_unspsc.id_code_unspsc', '=', 'fournisseur_code_unspsc_liaison.id_code_unspsc')
            ->where('fournisseur_code_unspsc_liaison.id_fournisseurs', $id_fournisseur)
            ->get();

        $categorieCode = $codes->groupBy('categorie');

        foreach ($categorieCode as $categorie => $items) {
            $categorieCode[$categorie] = $items->groupBy('classe_categorie');
        }

        return view('views.pageModInfo', compact('fournisseur', 'phonesWithoutContact', 'licences', 'categorieCode'));
    }

    public function ChangeInfo(UpdateSingleFieldRequest $request)
    {
        Log::info("//////////////////////// Start Change Info ////////////////////////");

        $validatedData = $request->validated();
        $Info = $validatedData['Info'];
        $TypeInfo = $validatedData['TypeInfo'];
        $id_fournisseurs = Auth::user()->id_fournisseurs;
        $telephoneId = $request->input('contact_id', null);
        

        Log::info('Change Info request received', [
            'TypeInfo' => $TypeInfo,
            'Info' => $Info,
            'id' => $id_fournisseurs,
            'contactID' => $telephoneId,
        ]);
        
       
        if (!$id_fournisseurs) {
            Log::error('Fournisseur ID missing from request');
            return redirect()->back()->with(['erreur' => 'Fournisseur ID is required.']);
        }


        if($telephoneId)
        {
            try {
                $updated = DB::table('telephone')
                    ->where('id_fournisseurs', $id_fournisseurs)
                    ->where('id_telephone', $telephoneId)
                    ->update([$TypeInfo => $Info]);
    
                if ($updated) {
                    Log::info("Successfully updated field '$TypeInfo' for fournisseur ID: $id_fournisseurs");
                    return redirect()->back()->with('success', 'Information changer');
                } else {
                    Log::warning("Update failed for fournisseur ID: $id_fournisseurs, no matching record or no changes.");
                    return redirect()->back()->with(['erreur' => 'Erreur assurez-vous de valider que vos informations suivent toutes les contraintes!']);
                }
            } catch (\Exception $e) {
                Log::error('Database update error', ['exception' => $e->getMessage()]);
                return redirect()->back()->with(['erreur' => 'Erreur en lien avec MYSQL']);
            }
        }
        else
        {
            try {
                $updated = DB::table('fournisseurs')
                    ->where('id_fournisseurs', $id_fournisseurs)
                    ->update([$TypeInfo => $Info]);
    
                if ($updated) {
                    Log::info("Successfully updated field '$TypeInfo' for fournisseur ID: $id_fournisseurs");
                    return redirect()->back()->with('success', 'Information changer');
                } else {
                    Log::warning("Update failed for fournisseur ID: $id_fournisseurs, no matching record or no changes.");
                    return redirect()->back()->with(['erreur' => 'Erreur assurez-vous de valider que vos informations suivent toutes les contraintes!']);
                }
            } catch (\Exception $e) {
                Log::error('Database update error', ['exception' => $e->getMessage()]);
                return redirect()->back()->with(['erreur' => 'Erreur en lien avec MYSQL']);
            }
        }

        
    }
}