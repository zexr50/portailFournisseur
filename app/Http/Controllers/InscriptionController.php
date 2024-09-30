<?php

namespace App\Http\Controllers;
use App\Models\LicencesRBQ;
use App\Models\CodesUNSPSC;
use App\Models\Fourniseur_code_unspsc_liaison;
use App\Models\Fourniseur_licences_rbq_liaison;
use App\Models\Personne_ressource;
use App\Models\Telephone;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class InscriptionController extends Controller
{
    public function index(Request $request)
    {
        $licences = LicencesRBQ::limit(20)->get();
        $categorie = $licences->groupBy('categorie');

        $code = CodesUNSPSC::limit(20)->get();
        $categorieCode = $code->groupBy('categorie');

        Log::info('some info');
        return view('views.pageInscription', compact('categorie', 'categorieCode'));
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

    public function store2(Request $request)
    {
        $request->validate([
            'NEQ' => 'required|string|max:10',
            'nom_entreprise' => 'required|string|max:64',
            'email' => 'required|string|max:64',
        ]);

        // Save the post in the first database
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Save the comment in the second database
        Comment::create([
            'post_id' => $post->id, // assuming you have a post_id in the comments table
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('succées', 'Le formulaire à bien été créer');
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $fournisseurData = $request->input('fournisseur');
        $fournisseur = Fournisseur::create($fournisseurData);


    
        // section pour les numéro de téléphone des founisseurs
        if ($request->has('no_tel.fournisseur')) {
            foreach ($request->input('no_tel.fournisseur') as $index => $phoneNumber) {
                Telephone::create([
                    'no_tel' => $phoneNumber,
                    'type_tel' => $request->input('type_tels.fournisseur.' . $index),
                    'poste_tel' => $request->input('poste_tel.fournisseur.' . $index),
                    'id_fournisseurs' => $fournisseur->id,
                ]);
            }
        }
    
        // section pour ce qui est des contacts/personne ressource.
        if ($request->has('no_tel.personne_ressource')) {
            foreach ($request->input('no_tel.personne_ressource') as $index => $jobPhoneNumber) {
                Personne_ressource::create([
                    'id_fournisseurs' => $fournisseur->id,
                    'prenom_contact' => $$request->input('prenom.personne_ressource.' . $index),
                    'nom_contact' => $request->input('nom.personne_ressource.' . $index),
                    'fonction' => $request->input('fonction.personne_ressource.' . $index),
                    'email_contact' => $request->input('email_contact.personne_ressource.' . $index), 
                ]);
                Telephone::create([
                    'no_tel' => $jobPhoneNumber,
                    'type_tel' => $request->input('type_tels.personne_ressource.' . $index),
                    'poste_tel' => $request->input('poste_tel.personne_ressource.' . $index),
                    'id_fournisseurs' => $fournisseur->id,
                ]);
            }
        }
 
        //partie pour les licences rbq
        $selectedLicences = $request->input('licences_rbq');

        foreach ($selectedLicences as $licenceId) {
            // Save or process each licence ID
        }

        //partie pour les code unspsc
        $selectedCodes = $request->input('codeUnspsc');

        foreach ($selectedCodes as $licenceId) {
            // Save or process each licence ID
        }
   
        return redirect()->route('persons.index')->with('success', 'Person created successfully!');
    }

}
