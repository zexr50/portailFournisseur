<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormInscription;
use App\Http\Requests\PhoneFormRequest;
use App\Http\Requests\PersonFormRequest;
use App\Http\Requests\TestRequest;
use App\Models\LicencesRBQ;
use App\Models\CodesUNSPSC;
use App\Models\Fourniseur_code_unspsc_liaison;
use App\Models\Fourniseur_licences_rbq_liaison;
use App\Models\Personne_ressource;
use App\Models\Telephone;
use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Demande;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public function index(Request $request)
    {
       
        return view('views.pageTest');
    }

    public function testFile(TestRequest $request)
    {
        Log::info('début du procéder de sauvegarde du fournisseur', [
            'request_data' => $request->all(),
            'timestamp' => now()->toDateTimeString(),
        ]);
        try {

            \Log::info('avant enregistrement fichier');
            // place pour sauvegarder les fichiers
            $paths = [];
            foreach ($request->file('file') as $file) {
                $filename = $fournisseur->id . '-' . time() . '-' . $file->getClientOriginalName(); // e.g., 1-1633023500-filename.ext

                // Store le fichier
                $path = $file->storeAs('', $filename, 'public'); // Store dans le root dans le disk public
                //$path = $file->storeAs('', $filename, 'custom2'); // le prendre pour le sauvegarder dans le disque avec le chemin personnalisé
                $paths[] = $path;
                $fileSizeInMB = round($file->size / 1048576, 2); // Taille en MB
                \Log::info('avant enregistrement fichier dans bd');
                Documents::create([
                    'id_fournisseur' => 1,
                    'cheminDocument' => $path,
                    'nomDocument' => $file->getClientOriginalName(),
                    'extension_document' => $file->getClientOriginalExtension(),
                    'taille_document' => $fileSizeInMB + 'MB',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            \Log::info('après foreach fichiers');

        } 
        catch (\Exception $e) {
            //Log::error('Erreur dans la fonction store du controller d\'inscription ' . $e->getMessage());
            //return redirect()->route('Inscription')->with('Erreur dans de formulaire');
        }
 
        return redirect()->route('Accueil')->with('success', 'Inscription faite!');
    }
}
