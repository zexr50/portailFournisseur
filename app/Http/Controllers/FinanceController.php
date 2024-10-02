<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        return view('views/pageAjoutFinancesFournisseur');
    }
    
    public function store(Request $request)
    {
        Log::info('Entre dans le store de FinanceController');

        $id_fournisseur = Auth::user()->id;

        try {
            $request->validate([
                'no_TPS' => 'required|string',
                'no_TVQ' => 'required|string',
                'condition_paiement' => 'required|string',
                'devise' => 'required|string',
                'mode_communication' => 'required|string',
            ]);
            Log::info('Après validation');

            
            Finance::create(array_merge($request->only(['no_TPS', 'no_TVQ', 'condition_paiement', 'devise', 'mode_communication']), ['id_fournisseur' => $id_fournisseur]));
            Log::info('Après form data');

            Log::info('Juste avant le return');
            return redirect()->back()->with('success', 'Data saved successfully!');

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving.'], 500);
        }
    }
}
