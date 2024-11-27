<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreFormInscription;
use App\Http\Requests\fileRequest;
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
use Illuminate\Support\Facades\Storage;


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
        $searchRBQ = $request->input('search2');
        $limit = $request->input('limit', 10);

        try {
            $licences = LicencesRBQ::where('sous_categorie','LIKE', "%{$searchRBQ}%")->limit($limit)->get();
            $categorie = $licences->groupBy('categorie');

            return view('partials.licencesRbqListe', compact('categorie'));

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->route('Inscription')->with('error', 'Il y a eu une erreur lors de la recherche');
        }
    }

    public function searchUNSPSC(Request $request)
    {
        $searchUNSPSC = $request->input('search2');
        $limit = $request->input('limit', 10);

        try {
            $unspsc = CodesUNSPSC::where('code_unspsc','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('categorie','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('classe_categorie','LIKE', "%{$searchUNSPSC}%")
            ->orWhere('precision_categorie','LIKE', "%{$searchUNSPSC}%")
            ->limit($limit)
            ->get();

            $categorieCode = $unspsc->groupBy('categorie');

            // Groupe par categorie
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
        DB::beginTransaction();
        $remember_token = Str::random(10);
        try {
            $fournisseurData = $request->input('fournisseur');
            Log::info('Fournisseur data extracted', ['data' => $fournisseurData]);

            if (isset($fournisseurData['mdp'])) {
                $fournisseurData['mdp'] = Hash::make($fournisseurData['mdp']);
            }

            $fournisseur = Fournisseur::create($fournisseurData);
            \Log::info('before creating user');
            $user = User::create([
                'id_fournisseurs' => $fournisseur->id,
                'name' => $fournisseur->nom_entreprise,
                'email' => $fournisseur->email,
                'NEQ' => $fournisseur->NEQ,
                'password' => $fournisseur->mdp,
                'remember_token' => $remember_token
            ]);
            Log::info('User created successfully', ['id_fournisseurs' => $fournisseur->id,'name' => $fournisseur->nom_entreprise, 'email' => $fournisseur->email,
             'NEQ' => $fournisseur->NEQ, 'password' => $fournisseur->mdp, 'remember_token' => $user->remember_token]);

              \Log::info('before the if for creating phone for the fournisseur');
            // section pour les numéro de téléphone des founisseurs
            if ($request->has('no_tel.fournisseur')) {
                $cleanPhone = preg_replace('/\D/', '', $request->input('no_tel.fournisseur'));
                Telephone::create([
                    'no_tel' => $cleanPhone,
                    'type_tel' => $request->input('type_tels.fournisseur'),
                    'poste_tel' => $request->input('poste_tel.fournisseur'),
                    'id_fournisseurs' => $fournisseur->id,
                ]); 
            }
        

            // section pour ce qui est des contacts/personne ressource.
            if ($request->has('no_tel.personne_ressource')) {
                $cleanPhone = preg_replace('/\D/', '', $request->input('no_tel.personne_ressource'));
                $telephone=Telephone::create([
                    'no_tel' => $cleanPhone,
                    'type_tel' => $request->input('type_tels.personne_ressource'),
                    'poste_tel' => $request->input('poste_tel.personne_ressource'),
                    'id_fournisseurs' => $fournisseur->id,
                ]);
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
                foreach ($selectedLicences as $licenceId) {
                    Fourniseur_licences_rbq_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_licence_rbq' => $licenceId,
                    ]);
                }
            }
            if ($request->has('codeUnspsc')) {
                $selectedCodes = json_decode($request->input('codeUnspsc'), true);
                foreach ($selectedCodes as $code_unspsc) {
                    Fourniseur_code_unspsc_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_code_unspsc' => $code_unspsc,
                    ]);
                }
            }

            Demande::create([
                'id_fournisseurs' => $fournisseur->id,
                'etat_demande' => 'en attente',
            ]);

            if ($request->has('fichiers') ) {
                $paths = [];
                $file = $request->file('fichiers');
                $uniqueId = uniqid();
                $filename = $fournisseur->id . '-' . $uniqueId . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                //$path = $file->storeAs('', $filename, 'custom2'); // le prendre pour le sauvegarder dans le disque avec le chemin personnalisé

                Documents::create([
                    'id_fournisseurs' => $fournisseur->id,
                    'cheminDocument' => $path,
                    'nomDocument' => $file->getClientOriginalName(),
                    'extension_document' => $file->getClientOriginalExtension(),
                    'taille_document' => $file->getSize(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                \Log::warning('No valid files found');
            }

            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('Inscription')->withErrors('Erreur dans de formulaire');
        }
        return redirect()->route('Accueil')->with('success', 'Inscription faite!');
    }

    public function storeFile(fileRequest $request)
    {
        try {
            $id_fournisseur = Auth::user()->id_fournisseurs;
            \Log::info('avant enregistrement fichier');
            if ($request->has('fichiers') ) {
                \Log::info('après le if pour fichier');

                $paths = [];
                $file = $request->file('fichiers');
                $uniqueId = uniqid();
                $filename = $id_fournisseur . '-' . $uniqueId . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                //$path = $file->storeAs('', $filename, 'custom2'); // le prendre pour le sauvegarder dans le disque avec le chemin personnalisé

                \Log::info('avant enregistrement fichier dans bd');
                Documents::create([
                    'id_fournisseurs' => $id_fournisseur,
                    'cheminDocument' => $path,
                    'nomDocument' => $file->getClientOriginalName(),
                    'extension_document' => $file->getClientOriginalExtension(),
                    'taille_document' => $file->getSize(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                \Log::warning('No valid files found');
            }
            \Log::info('après if enregistrement des fichiers');
        } 
        catch (\Exception $e) {
            Log::error('Erreur dans la fonction store du controller d\'inscription ' . $e->getMessage());
            return redirect()->route('Inscription')->with('Erreur dans de formulaire');
        }
        return redirect()->route('MenuFournisseur')->with('success', 'Document enregistrer!');
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

        // Groupe par categorie
        foreach ($categorieCode as $categorie => $items) {
            $categorieCode[$categorie] = $items->groupBy('classe_categorie');
        }

        $fichiers = Documents::where('id_fournisseurs', $id_fournisseur)->get();

        if (!$fournisseur) {
            abort(404);
        }
        return view('views.pageVoirFiche', 
        compact('fournisseur', 'phonesWithoutContact', 'licences', 'categorieCode', 'fichiers')); 
    }

    public function download($id_document)
    {
        \Log::info('Before download');

        //$fichier = Documents::findOrFail($id_document);
        $fichier = Documents::where('id_document', $id_document)->first();

        $filePath = $fichier->cheminDocument;
        $fileName = $fichier->nomDocument;
    
        // Verifier si le fichier existe avant de chercher
        if (!Storage::disk('public')->exists($filePath)) {
            \Log::error("File not found: $filePath");
            abort(404, 'File not found');
        }
    
        $fileSize = Storage::disk('public')->size($filePath);
        $mimeType = Storage::disk('public')->mimeType($filePath);
    
        return response()->download(storage_path("app/public/$filePath"), $fileName, [
            'Content-Length' => $fileSize,
            'Content-Type' => $mimeType,
        ]);
    }
}
