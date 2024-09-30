<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormInscription extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.nom_entreprise' => 'required|string|max:64',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
            'fournisseur.NEQ' => 'required|string|max:255',
        ];
    }
}
