<?php

namespace App\Http\Controllers;
use App\Models\LicencesRBQ;
use App\Models\CodesUNSPSC;
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

}
