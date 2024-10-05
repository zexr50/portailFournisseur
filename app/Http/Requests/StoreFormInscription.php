<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
            'fournisseur.NEQ' => 'nullable|string|max:255',
            'fournisseur.nom_entreprise' => 'required|string|max:64',
            'fournisseur.email' => 'nullable|string|max:64',
            'fournisseur.mdp' => 'required|string|max:2048',
            'fournisseur.no_rue' => 'required|string|max:8',
            'fournisseur.rue' => 'required|string|max:8',
            'fournisseur.no_bureau' => 'nullable|string|max:64',
            'fournisseur.ville' => 'required|string|max:64',
            'fournisseur.province' => 'required|string|in:Quebec,Alberta,Colombie-Britannique,Ile-du-Prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Ecosse,Ontario,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon', 
            'fournisseur.no_region_admin' => 'required|string|in:01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17',
            'fournisseur.code_postal' => 'required|string|max:6',
            'fournisseur.site_internet' => 'nullable|string|max:64',

            'type_tels.fournisseur' => 'nullable|array',
            'type_tels.fournisseur.*' => 'required|string|in:bureau,cellulaire,fax',
            
            'no_tel.fournisseur' => 'nullable|array',
            'no_tel.fournisseur.*' => 'required|string|max:15',
            
            'poste_tel.fournisseur' => 'nullable|array',
            'poste_tel.fournisseur.*' => 'nullable|string|max:10',


            'prenom.personne_ressource' => 'nullable|array',
            'prenom.personne_ressource.*' => 'required|string|max:32',

            'nom.personne_ressource' => 'nullable|array',
            'nom.personne_ressource.*' => 'required|string|max:32',

            'fonction.personne_ressource' => 'nullable|array',
            'fonction.personne_ressource.*' => 'required|string|max:32',

            'email_contact.personne_ressource' => 'nullable|array',
            'email_contact.personne_ressource.*' => 'required|string|max:32',

            'type_tels.personne_ressource' => 'nullable|array',
            'type_tels.personne_ressource.*' => 'required|string|in:bureau,cellulaire,fax',
            
            'no_tel.personne_ressource' => 'nullable|array',
            'no_tel.personne_ressource.*' => 'required|string|max:15',
            
            'poste_tel.personne_ressource' => 'nullable|array',
            'poste_tel.personne_ressource.*' => 'nullable|string|max:10',


            'licences_rbq' => 'nullable|json',
            //'licences_rbq' => 'nullable|array', // Ensure the array is present
            //'licences_rbq.*' => 'nullable|integer', // Validate each checkbox as an integer

            'codeUnspsc' => 'nullable|json',
            //'codeUnspsc' => 'nullable|array', // Ensure the array is present
            //'codeUnspsc.*' => 'nullable|integer', // Validate each checkbox as an integer
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Log the request data
        Log::error('Validation failed', [
            'errors' => $validator->errors(),
            'request_data' => $this->all(),
        ]);

        // Throw the validation exception
        throw new ValidationException($validator);
    }
}
