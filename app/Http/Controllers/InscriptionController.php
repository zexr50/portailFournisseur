<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreFormInscription;
use App\Models\LicencesRBQ;
use App\Models\CodesUNSPSC;
use App\Models\Fourniseur_code_unspsc_liaison;
use App\Models\Fourniseur_licences_rbq_liaison;
use App\Models\Personne_ressource;
use App\Models\Telephone;
use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class InscriptionController extends Controller
{
    public function index(Request $request)
    {
        $licences = LicencesRBQ::limit(100)->get();
        $categorie = $licences->groupBy('categorie');

        return view('views.pageInscription', compact('categorie'));
    }

    public function index2(Request $request)
    {
        $query = LicencesRBQ::query();
    
        if ($request->has('search')) {
            $query->where('sous_categorie', 'like', '%' . $request->search . '%');
        }
    
        $licences_rbqs = $query->paginate(50);

        if ($request->ajax()) {
            return view('views.partials.pageInscription', compact('licences_rbqs'))->render();
        }

        return view('views.pageInscription', compact('licences_rbqs'));
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
            return response()->json(['error' => 'An error occurred while searching.'], 500);
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

            Log::info($categorieCode);

            Log::info('juste avant le retour à la vue partiel');
            return view('partials.codeUnspscListe', compact('categorieCode'));

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while searching.'], 500);
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
        Log::info('Starting the store process for fournisseur', [
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
            Log::info('Fournisseur created successfully', ['fournisseur_id' => $fournisseur->id]);

            \Log::info('before creating user');
            User::create([
                'id_fournisseurs' => $fournisseur->id,
                'name' => $fournisseur->nom_entreprise,
                'email' => $fournisseur->email,
                'NEQ' => $fournisseur->NEQ,
                'password' => $fournisseur->mdp,
            ]);
            Log::info('User created successfully', ['name' => $fournisseur->nom_entreprise, 'email' => $fournisseur->email,
             'NEQ' => $fournisseur->NEQ, 'password' => $fournisseur->mdp]);


              \Log::info('before the if for creating phone for the fournisseur');
            // section pour les numéro de téléphone des founisseurs
            if ($request->has('no_tel.fournisseur')) {
                foreach ($request->input('no_tel.fournisseur') as $index => $phoneNumber) {
                    \Log::info('before the Telephone  create for fournisseur');
                    $cleanPhone = preg_replace('/\D/', '', $phoneNumber);
                    Telephone::create([
                        'no_tel' => $cleanPhone,
                        'type_tel' => $request->input('type_tels.fournisseur.' . $index),
                        'poste_tel' => $request->input('poste_tel.fournisseur.' . $index),
                        'id_fournisseurs' => $fournisseur->id,
                    ]);
                    Log::info('Telephone created successfully', ['no_tel' => $phoneNumber],
                    ['type_tel' => $request->input('type_tels.fournisseur.' . $index)],
                     ['poste_tel' => $request->input('poste_tel.fournisseur.' . $index)],
                     ['id_fournisseurs' => $fournisseur->id]);
                }
            }
        

            \Log::info('before the if for creating contact and phone for the contacts');
            // section pour ce qui est des contacts/personne ressource.
            if ($request->has('no_tel.personne_ressource')) {
                foreach ($request->input('no_tel.personne_ressource') as $index => $jobPhoneNumber) {
                    \Log::info('before the Telephone create for the contacts');
                    $cleanPhone = preg_replace('/\D/', '', $jobPhoneNumber);
                    $telephone=Telephone::create([
                        'no_tel' => $cleanPhone,
                        'type_tel' => $request->input('type_tels.personne_ressource.' . $index),
                        'poste_tel' => $request->input('poste_tel.personne_ressource.' . $index),
                        'id_fournisseurs' => $fournisseur->id,
                    ]);
                    Log::info('Telephone created successfully', 
                    ['no_tel' => $cleanPhone,
                    'type_tel' => $request->input('type_tels.personne_ressource.' . $index),
                    'poste_tel' => $request->input('poste_tel.personne_ressource.' . $index),
                    'id_fournisseurs' => $fournisseur->id]);
                    \Log::info('before the Personne_ressource create');
                    Personne_ressource::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_telephone' => $telephone->id,
                        'prenom_contact' => $request->input('prenom.personne_ressource.' . $index),
                        'nom_contact' => $request->input('nom.personne_ressource.' . $index),
                        //'nom_contact' => $request->input('nom.personne_ressource.' . $index), //c\'est ici qu\'il y a l\'érreur
                        'fonction' => $request->input('fonction.personne_ressource.' . $index),
                        'email_contact' => $request->input('email_contact.personne_ressource.' . $index), 
                    ]);
                }
            }
    

            if ($request->has('licences_rbq')) {
                $selectedLicences = json_decode($request->input('licences_rbq'), true);
                Log::info('selectedLicences data extracted', ['data' => $selectedLicences]);
            
                \Log::info('before the creation of licenceId');
                foreach ($selectedLicences as $licenceId) {
                    Fourniseur_licences_rbq_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_licence_rbq' => $licenceId,
                    ]);
                    Log::info('Licences created successfully', 
                        ['id_fournisseurs' => $fournisseur->id,
                        'id_licence_rbq' => $licenceId]);
                }
            }


            if ($request->has('codeUnspsc')) {
                $selectedCodes = json_decode($request->input('codeUnspsc'), true);
                Log::info('selectedCodes data extracted', ['data' => $selectedCodes]);
            
                \Log::info('before the creation of licenceId');
                foreach ($selectedCodes as $code_unspsc) {
                    Fourniseur_code_unspsc_liaison::create([
                        'id_fournisseurs' => $fournisseur->id,
                        'id_code_unspsc' => $code_unspsc,
                    ]);
                    Log::info('code UNSPSC created successfully', 
                        ['id_fournisseurs' => $fournisseur->id,
                        'id_code_unspsc' => $code_unspsc]);
                }
            }

            \Log::info('before creating demande');
            Demande::create([
                'id_fournisseur' => $fournisseur->id,
                'etat_demande' => 'en attente',
            ]);

            Log::info('User created successfully', ['name' => $fournisseur->nom_entreprise, 'email' => $fournisseur->email,
             'NEQ' => $fournisseur->NEQ, 'password' => $fournisseur->mdp]);



        } 
        catch (\Exception $e) {
            Log::error('Erreur dans la fonction store du controller d\'inscription ' . $e->getMessage());
            //Log::error('Stack trace: ' . $e->getTraceAsString()); // Log the stack trace
            return response()->json(['error' => 'Erreur dans le create.'], 500);
        }
 
        return redirect()->route('Accueil')->with('success', 'Inscription faite!');
    }

}
