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
            'fournisseur.email' => 'required|string|max:64',
            'fournisseur.mdp' => 'required|string|max:2048',
            'fournisseur.no_rue' => 'required|string|max:8',
            'fournisseur.no_bureau' => 'required|string|max:64',
            'fournisseur.ville' => 'required|string|max:64',
            'fournisseur.province' => 'required|string|in:Quebec,Alberta,Colombie-Britannique,Ile-du-Prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Ecosse,Ontario,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon', 
            'fournisseur.no_region_admin' => 'required|string|in:01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17',
            'fournisseur.code_postal' => 'required|string|max:6',
            'fournisseur.site_internet' => 'required|string|max:64',

            'personne_ressource.*.prenom_contact' => 'required|string|max:32',
            'personne_ressource.*.nom_contact' => 'required|string|max:32',
            'personne_ressource.*.fonction' => 'required|string|max:32',
            'personne_ressource.*.email_contact' => 'required|string|max:64',

            'type_tels.person' => 'nullable|array',
            'type_tels.person.*' => 'required|string|in:bureau,cellulaire,fax',
            
            'no_tel_contact.person' => 'nullable|array',
            'no_tel_contact.person.*' => 'required|string|max:15',
            
            'poste_tel_contact.person' => 'nullable|array',
            'poste_tel_contact.person.*' => 'nullable|string|max:10',

            'type_tels.job' => 'nullable|array',
            'type_tels.job.*' => 'required|string|in:bureau,cellulaire,fax',
            
            'no_tel_contact.job' => 'nullable|array',
            'no_tel_contact.job.*' => 'required|string|max:15',
            
            'poste_tel_contact.job' => 'nullable|array',
            'poste_tel_contact.job.*' => 'nullable|string|max:10',
        ];
    }
}
