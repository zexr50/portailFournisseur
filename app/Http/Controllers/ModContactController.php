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

class ModContactController extends Controller
{
    public function index()
    {
        $id_fournisseur =  Auth::user()->id_fournisseurs;
        //Log::info($id_fournisseur);
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

        return view('views.pageModContact', compact('fournisseur'));
    }

    public function ChangeContact(UpdateSingleFieldRequest $request)
    {
        Log::info("//////////////////////// Start Change Contact ////////////////////////");

        $validatedData = $request->validated();

        $Info = $validatedData['Info'];
        $TypeInfo = $validatedData['TypeInfo'];
        $id_fournisseurs =  Auth::user()->id_fournisseurs;
        $contactId = $request->input('contact_id');

        /*
            Log::info('Change Info request received', [
                'TypeInfo' => $TypeInfo,
                'Info' => $Info,
                'id' => $id_fournisseurs,
                "ContactId" => $contactId,
            ]);
        */
        
        if (!$id_fournisseurs) {
            Log::error('Fournisseur ID missing from request');
            return redirect()->back()->with(['erreur' => 'Fournisseur ID is required.']);
        }

        if($TypeInfo == "fonction" || $TypeInfo == "prenom_contact" || $TypeInfo == "nom_contact" || $TypeInfo == "email_contact")
        {
            try {
                $updated = DB::table('personne_ressource')
                    ->where('id_fournisseurs', $id_fournisseurs)
                    ->where('id_personne_ressource', $contactId)
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
                $idTelephone = DB::table('personne_ressource')
                    ->where('id_fournisseurs', $id_fournisseurs)
                    ->where('id_personne_ressource', $contactId)
                    ->value('id_telephone');
        
                if ($idTelephone) {
                    Log::info("id telephone = $idTelephone");
                    try {
                        $updated = DB::table('telephone')
                            ->where('id_fournisseurs', $id_fournisseurs)
                            ->where('id_telephone', $idTelephone)
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

                } else {
                    return response()->json(['error' => 'No matching record found'], 404);
                }
            } catch (\Exception $e) {
                Log::error('Database update error', ['exception' => $e->getMessage()]);
                return redirect()->back()->with(['erreur' => 'Erreur en lien avec MYSQL']);
            }
        }
        
    }
}
