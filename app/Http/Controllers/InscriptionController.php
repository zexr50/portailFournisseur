<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreFormInscription;
use App\Http\Requests\PhoneFormRequest;
use App\Http\Requests\PersonFormRequest;
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


class InscriptionController extends Controller
{
    public function index(Request $request)
    {
        $licences = LicencesRBQ::limit(100)->get();
        $categorie = $licences->groupBy('categorie');

        return view('views.pageInscription', compact('categorie'));
    }

    public function searchRBQ(Request $request)
    {
        Log::info('début fonction searchRBQ');
        $searchRBQ = $request->input('search2');
        $limit = $request->input('limit', 10);
        Log::info($searchRBQ);
        Log::info($limit);

        try {
            $licences = LicencesRBQ::where('sous_categorie','LIKE', "%{$searchRBQ}%")->limit($limit)->get();
            Log::info($licences);
            $categorie = $licences->groupBy('categorie');
            Log::info($categorie);

            Log::info('juste avant le retour à la vue partiel');
            return view('partials.licencesRbqListe', compact('categorie'));

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->route('Inscription')->with('error', 'Il y a eu une erreur lors de la recherche');
        }
    }

    public function searchUNSPSC(Request $request)
    {
        Log::info('début fonction searchRBQ');
        $searchUNSPSC = $request->input('search2');
        $limit = $request->input('limit', 10);
        Log::info($searchUNSPSC);
        Log::info($limit);

        try {
            $unspsc = CodesUNSPSC::where('code_unspsc','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('categorie','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('classe_categorie','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('precision_categorie','LIKE', "%{$searchUNSPSC}%")
            ->limit($limit)
            ->get();
            Log::info($unspsc);

            $categorieCode = $unspsc->groupBy('categorie');
            Log::info($categorieCode);

            // For each category, group by classe_categorie
            foreach ($categorieCode as $categorie => $items) {
                $categorieCode[$categorie] = $items->groupBy('classe_categorie');
            }

            return view('partials.codeUnspscListe', compact('categorieCode'));

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->route('Inscription')->with('error', 'Il y a eu une erreur lors de la recherche');
        }
    }

    public function searchModel(Request $request)
    {
        $searchTerm = $request->input('search1');
        $products = LicencesRBQ::where('name', 'LIKE', "%{$searchTerm}%")->limit(50)->get();

        return view('products.partials.product_list_db1', compact('products'));
    }

    public function store(StoreFormInscription $request)
    {
        Log::info('début du procéder de sauvegarde du fournisseur', [
            'request_data' => $request->all(),
            'timestamp' => now()->toDateTimeString(),
        ]);
        try {
            \Log::info($request->all());
            $fournisseurData = $request->input('fournisseur');
            Log::info('Fournisseur data extracted', ['data' => $fournisseurData]);

            if (isset($fournisseurData['mdp'])) {
                $fournisseurData['mdp'] = Hash::make($fournisseurData['mdp']);
            }

            $fournisseur = Fournisseur::create($fournisseurData);
            \Log::info('before creating user');
            User::create([
                'id_fournisseurs' => $fournisseur->id,
                'name' => $fournisseur->nom_entreprise,
                'email' => $fournisseur->email,
                'NEQ' => $fournisseur->NEQ,
                'password' => $fournisseur->mdp,
                'remember_token' => Str::random(10)
            ]);
            Log::info('User created successfully', ['id_fournisseurs' => $fournisseur->id,'name' => $fournisseur->nom_entreprise, 'email' => $fournisseur->email,
             'NEQ' => $fournisseur->NEQ, 'password' => $fournisseur->mdp]);


              \Log::info('before the if for creating phone for the fournisseur');
            // section pour les numéro de téléphone des founisseurs
            if ($request->has('no_tel.fournisseur')) {
                \Log::info('before the Telephone  create for fournisseur');
                $cleanPhone = preg_replace('/\D/', '', $request->input('no_tel.fournisseur'));
                Telephone::create([
                    'no_tel' => $cleanPhone,
                    'type_tel' => $request->input('type_tels.fournisseur'),
                    'poste_tel' => $request->input('poste_tel.fournisseur'),
                    'id_fournisseurs' => $fournisseur->id,
                ]); 
                \Log::info('after the Telephone  create for fournisseur');
            }
        

            \Log::info('before the if for creating contact and phone for the contacts');
            // section pour ce qui est des contacts/personne ressource.
            if ($request->has('no_tel.personne_ressource')) {
                \Log::info('before the Telephone create for the contacts');
                $cleanPhone = preg_replace('/\D/', '', $request->input('no_tel.personne_ressource'));
                $telephone=Telephone::create([
                    'no_tel' => $cleanPhone,
                    'type_tel' => $request->input('type_tels.personne_ressource'),
                    'poste_tel' => $request->input('poste_tel.personne_ressource'),
                    'id_fournisseurs' => $fournisseur->id,
                ]);
                \Log::info('before the Personne_ressource create');
                Personne_ressource::create([
                    'id_fournisseurs' => $fournisseur->id,
                    'id_telephone' => $telephone->id,
                    'prenom_contact' => $request->input('prenom.personne_ressource'),
                    'nom_contact' => $request->input('nom.personne_ressource'),
                    'fonction' => $request->input('fonction.personne_ressource'),
                    'email_contact' => $request->input('email_contact.personne_ressource'), 
                ]);
            }
    

            if ($request->has('licences_rbq')) {
                $selectedLicences = json_decode($request->input('licences_rbq'), true);
                \Log::info('before the creation of licenceId');
                foreach ($selectedLicences as $licenceId) {
                    Fourniseur_licences_rbq_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_licence_rbq' => $licenceId,
                    ]);
                }
            }


            if ($request->has('codeUnspsc')) {
                $selectedCodes = json_decode($request->input('codeUnspsc'), true);
                \Log::info('before the creation of licenceId');
                foreach ($selectedCodes as $code_unspsc) {
                    Fourniseur_code_unspsc_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_code_unspsc' => $code_unspsc,
                    ]);
                }
            }

            \Log::info('before creating demande');
            Demande::create([
                'id_fournisseurs' => $fournisseur->id,
                'etat_demande' => 'en attente',
            ]);


            \Log::info('avant enregistrement fichier');
            if ($request->has('file')) {
                // place pour sauvegarder les fichiers
                \Log::info('après le if pour fichier');
                $paths = [];
                foreach ($request->file('file') as $file) {
                    $filename = $fournisseur->id . '-' . time() . '-' . $file->getClientOriginalName(); // e.g., 1-1633023500-filename.ext

                    // Store the file with the new filename
                    $path = $file->storeAs('', $filename, 'public'); // Store in the root of the public disk
                    //$path = $file->storeAs('', $filename, 'custom2'); // le prendre pour le sauvegarder dans le disque avec le chemin personnalisé
                    $paths[] = $path;
                    $fileSizeInMB = round($file->size / 1048576, 2); // Size in MB
                    \Log::info('avant enregistrement fichier dans bd');
                    Documents::create([
                        'id_fournisseur' => $fournisseur->id,
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

        } 
        catch (\Exception $e) {
            Log::error('Erreur dans la fonction store du controller d\'inscription ' . $e->getMessage());
            return redirect()->route('Inscription')->with('Erreur dans de formulaire');
        }
 
        return redirect()->route('Accueil')->with('success', 'Inscription faite!');
    }

    public function addPhone(PhoneFormRequest $request)
    {
        $id_fournisseur = Auth::user()->id_fournisseurs;
        \Log::info('before the Telephone  create for fournisseur');
        $phone = $request->input('no_tel.fournisseur');
        $cleanPhone = preg_replace('/\D/', '', $phone);
        Telephone::create([
            'no_tel' => $cleanPhone,
            'type_tel' => $request->input('type_tels.fournisseur'),
            'poste_tel' => $request->input('poste_tel.fournisseur'),
            'id_fournisseurs' => $id_fournisseur,
        ]);
        Log::info('Telephone created successfully', ['no_tel' => $cleanPhone,
        'type_tel' => $request->input('type_tels.fournisseur'),
        'poste_tel' => $request->input('poste_tel.fournisseur'),
        'id_fournisseurs' => $id_fournisseur]);


        return redirect()->route('MenuFournisseur')->with('success', 'Ajout du numéro de téléphone réussite!');
    }

    public function addPerson(PersonFormRequest $request)
    {
        $id_fournisseur = Auth::user()->id_fournisseurs;

        \Log::info('before the Telephone create for cantacte');
        $phone = $request->input('no_tel.personne_ressource');
        $cleanPhone = preg_replace('/\D/', '', $phone);
        $telephone=Telephone::create([
            'no_tel' => $cleanPhone,
            'type_tel' => $request->input('type_tels.personne_ressource'),
            'poste_tel' => $request->input('poste_tel.personne_ressource'),
            'id_fournisseurs' => $id_fournisseur,
        ]);
        Log::info('Telephone created successfully', ['no_tel' => $cleanPhone,
        'type_tel' => $request->input('type_tels.personne_ressource'),
        'poste_tel' => $request->input('poste_tel.personne_ressource'),
        'id_fournisseurs' => $id_fournisseur]);

        \Log::info('before the if for creating contact and phone for the contacts');
        Personne_ressource::create([
            'id_fournisseurs' => $id_fournisseur,
            'id_telephone' => $telephone->id,
            'prenom_contact' => $request->input('prenom.personne_ressource'),
            'nom_contact' => $request->input('nom.personne_ressource'),
            'fonction' => $request->input('fonction.personne_ressource'),
            'email_contact' => $request->input('email_contact.personne_ressource'), 
        ]);




        return redirect()->route('MenuFournisseur')->with('success', 'Ajout de la personne contacte réussite!');
    }

    public function formAddPhone(Request $request)
    {
        return view('views.pageInscriptionAjoutTelephone');
    }

    public function formAddPerson(Request $request)
    {
        return view('views.pageInscriptionAjoutContacte');
    }

    public function show()
    {
        $id_fournisseur = Auth::user()->id_fournisseurs;
        $fournisseur = Fournisseur::with([
            'region',
            'telephones',
            'personne_ressources.telephones',
            'demande'
        ])->where('id_fournisseurs', $id_fournisseur)
        ->first();

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
        Log::info($categorieCode);

        // For each category, group by classe_categorie
        foreach ($categorieCode as $categorie => $items) {
            $categorieCode[$categorie] = $items->groupBy('classe_categorie');
        }

        if (!$fournisseur) {
            abort(404);
        }

        return view('views.pageVoirFiche', 
        compact('fournisseur', 'phonesWithoutContact', 'licences', 'categorieCode')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function test()
    {
        //
    }

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
