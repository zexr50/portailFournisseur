<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Illuminate\Support\Facades\Log;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        return view('views/pageAjoutFinancesFournisseur');
    }
    
    public function store(Request $request)
    {
        Log::info('entre dans le store de FincanceController');

        try {
            $request->validate([
                'id_fournisseur' => 'required|int',
                'no_TPS' => 'required|string',
                'no_TVQ' => 'required|string',
                'condition_paiement' => 'required|string',
                'devise' => 'required|string',
                'mode_communication' => 'required|string',
            ]);
            Log::info('après validation');
    
            FormData::create($request->only(['id_fournisseur', 'no_TPS', 'no_TVQ', 'condition_paiement', 'devise', 'mode_communication']));
            Log::info('après form data');
    
            Log::info('juste avant le return');
            return redirect()->back()->with('success', 'Data saved successfully!');

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while searching.'], 500);
        }
    }
}
