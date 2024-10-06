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
            'fournisseur.NEQ' => 'nullable|string|max:255|regex:/^[1238]\1[456789]\d{7}$/',
            'fournisseur.nom_entreprise' => 'required|string|max:64|regex:/^[a-zA-Z0-9]+$/',
            'fournisseur.email' => 'nullable|string|max:64|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,}$/',
            'fournisseur.mdp' => 'required|string|max:2048|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,12}$/',
            'fournisseur.no_rue' => 'required|string|max:8|regex:/^[0-9]{1,8}$/',
            'fournisseur.rue' => "required|string|max:64|regex:/^[a-zA-ZÀ-ÿ0-9\s'’-]+(?:\s[a-zA-ZÀ-ÿ0-9\s'’-]+)*$/",
            'fournisseur.no_bureau' => 'nullable|string|max:16|regex:/^[0-9]{1,16}$/',
            'fournisseur.ville' => "required|string|max:64|regex:/^[a-zA-ZÀ-ÿ0-9\s'’-]+(?:\s[a-zA-ZÀ-ÿ0-9\s'’-]+)*$/",
            'fournisseur.province' => 'required|string|in:Quebec,Alberta,Colombie-Britannique,Ile-du-Prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Ecosse,Ontario,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon', 
            'fournisseur.no_region_admin' => 'required|string|in:00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17',
            'fournisseur.code_postal' => 'required|string|max:8|regex:/^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/',
            'fournisseur.site_internet' => 'nullable|string|max:64|regex:/^[a-zA-Z0-9]+$/',

            'type_tels.fournisseur' => 'nullable|array',
            'type_tels.fournisseur.*' => 'required|string|in:bureau,cellulaire,fax',
            
            'no_tel.fournisseur' => 'nullable|array',
            'no_tel.fournisseur.*' => 'required|string|max:15|regex:/^[0-9]+$/',
            
            'poste_tel.fournisseur' => 'nullable|array',
            'poste_tel.fournisseur.*' => 'nullable|string|max:10|regex:/^[0-9]+$/',


            'prenom.personne_ressource' => 'nullable|array',
            'prenom.personne_ressource.*' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{,32}$/',

            'nom.personne_ressource' => 'nullable|array',
            'nom.personne_ressource.*' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{,32}$/',

            'fonction.personne_ressource' => 'nullable|array',
            'fonction.personne_ressource.*' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{,32}$/',

            'email_contact.personne_ressource' => 'nullable|array',
            'email_contact.personne_ressource.*' => 'nullable|string|max:32|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,}$/',

            'type_tels.personne_ressource' => 'nullable|array',
            'type_tels.personne_ressource.*' => 'nullable|string|in:bureau,cellulaire,fax',
            
            'no_tel.personne_ressource' => 'nullable|array',
            'no_tel.personne_ressource.*' => 'nullable|string|max:15|regex:/^[0-9]+$/',
            
            'poste_tel.personne_ressource' => 'nullable|array',
            'poste_tel.personne_ressource.*' => 'nullable|string|max:10|regex:/^[0-9]+$/',


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

    public function messages()
{
    return [
        //a faire un peu plus, mais cela va prendre du temps.
        'fournisseur.nom_entreprise.required' => 'Vous devez fournir un nom d\'entreprise.',
        'fournisseur.nom_entreprise.regex' => 'Le nom d\'entreprise doit seuleument contenir des lettres et des chiffres.',
        
    ];
}
}
