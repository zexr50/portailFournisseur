<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_fournisseur' => 'required|int',
            'no_TPS' => 'required|string',
            'no_TVQ' => 'required|string',
            'condition_paiement' => 'required|string',
            'devise' => 'required|string',
            'mode_communication' => 'required|string',
        ]);

        FormData::create($request->only(['id_fournisseur', 'no_TPS', 'no_TVQ', 'condition_paiement', 'devise', 'mode_communication']));

        return redirect()->back()->with('success', 'Data saved successfully!');
    }
}
