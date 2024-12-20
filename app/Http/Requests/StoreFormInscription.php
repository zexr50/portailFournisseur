<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreFormInscription extends FormRequest
{
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
            'fournisseur.NEQ' => 'nullable|string|max:15|regex:/^([1238])\1\d{8}$/|unique:users,NEQ',
            'fournisseur.nom_entreprise' => 'required|string|max:64',
            'fournisseur.email' => 'required|string|max:64|regex:/^[\w\.-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,6}(\.[a-zA-Z]{2,6})?$/',
            'fournisseur.mdp' => 'required|string|max:15|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,12}$/',
            'fournisseur.mdp_confirmation' => 'required|string|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,12}$/',
            'fournisseur.no_rue' => 'required|string|max:8|regex:/^[a-zA-Z0-9 _-]{1,8}$/',
            'fournisseur.rue' => 'required|string|max:64',
            'fournisseur.no_bureau' => 'nullable|string|max:16|regex:/^[a-zA-Z0-9 _-]{1,8}$/',

            'fournisseur.ville' => 'required|string|max:64',
            'fournisseur.province' => 'required|string|in:Quebec,Alberta,Colombie-Britannique,Ile-du-Prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Ecosse,Ontario,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon', 
            'fournisseur.no_region_admin' => 'required|string|in:00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17',
            'fournisseur.code_postal' => 'required|string|max:8|regex:/^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i',
            'fournisseur.site_internet' => 'nullable|string|max:64|regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9\-]+(\.[a-zA-Z]{2,})+)(\/[^\s]*)?$/',
            'fournisseur.commentaire' => 'nullable|string|max:500',

            'type_tel.fournisseur' => 'nullable|string|in:bureau,cellulaire,fax',
            'no_tel.fournisseur' => 'nullable|string|max:20|regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,3}\)?[-.\s]?)?(\d{3,4}[-.\s]?)?\d{4}$/',
            'poste_tel.fournisseur' => 'nullable|string|max:10|regex:/^[0-9]+$/',

            'prenom.personne_ressource' => 'nullable|string|max:32|regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\' _-]{1,32}$/', //^[a-zA-ZÀ-ÖØ-öø-ÿ\' _-]+
            'nom.personne_ressource' => 'nullable|string|max:32|regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\' _-]{1,32}$/',
            'fonction.personne_ressource' => 'nullable|string|max:32',
            'email_contact.personne_ressource' => 'nullable|string|max:32|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,}$/',

            'type_tel.personne_ressource' => 'nullable|string|in:bureau,cellulaire,fax',
            'no_tel.personne_ressource' => 'nullable|string|max:20|regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,3}\)?[-.\s]?)?(\d{3,4}[-.\s]?)?\d{3,4}$/',
            'poste_tel.personne_ressource' => 'nullable|string|max:10|regex:/^[0-9]+$/',

            'licences_rbq' => 'nullable|json',
            'codeUnspsc' => 'nullable|json',

            'fichiers' => 'nullable|file|mimes:jpeg,png,gif,svg,bmp,pdf,txt,doc,docx,xls,xlsx,ppt,pptx',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error('Validation failed', [
            'errors' => $validator->errors(),
            'request_data' => $this->all(),
        ]);

        throw new ValidationException($validator);
    }

    public function messages()
    {
        return [
            'fournisseur.NEQ.regex' => 'Votre numéro d\'entreprise du Québec n\'a pas le format valide.',
            'fournisseur.NEQ.unique' => 'Votre numéro d\'entreprise du Québec à déjà été enregistrer, vérifier que c\'est bel et bien le bon NEQ.',
            'fournisseur.nom_entreprise.required' => 'Vous devez fournir un nom d\'entreprise.',
            'fournisseur.nom_entreprise.regex' => 'Le nom d\'entreprise doit seuleument contenir des lettres, des chiffres ainsi que c\'est caractére-ci : "’‘-.".',
            'fournisseur.email.regex' => 'L\'adresse courriel doit être valide de format email@email.com.',
            'fournisseur.email.max' => 'L\'adresse courriel doit être de 64 caractère ou moins.',
            'fournisseur.mdp.required' => 'Vous devez entrer un mot de passe.',
            'fournisseur.mdp.regex' => 'Le mot de passe doit être de 7-12 de long, avoir une majuscule, une minuscule, au moins 1 chiffre ainsi qu\'un symbol spécial.',
            
            'fournisseur.no_rue.required' => 'Vous devez entrer un numéro civique.',
            'fournisseur.no_rue.regex' => 'Le numéro de rue doit être entre 1 et 8 chiffres.',
            'fournisseur.rue.required' => 'Vous devez entrer un nom de rue.',
            'fournisseur.rue.regex' => 'Le nom de la rue ne doit pas contenir de caracteres spéciaux.',
            'fournisseur.no_bureau.regex' => 'Le numéro du bureau doit etre de 1 à 8.',
            'fournisseur.ville.required' => 'Vous devez entrer une ville.',
            'fournisseur.ville.regex' => 'Le nom de la ville ne doit pas contenir de caracteres spéciaux.',
            'fournisseur.code_postal.required' => 'Vous devez entrer un code postal.',
            'fournisseur.code_postal.regex' => 'Le code postal doit être conforme au pattern du Canada (A1A-1A1).',
            
            'fournisseur.site_internet.regex' => 'L\'URL ne doit pas contenir d\'espaces ou de caracteres spéciaux.',

            'prenom.personne_ressource.regex' => 'Le prenom doit être entre 1-32 caracteres et ne doit pas contenir de caracteres spéciaux.',
            'nom.personne_ressource.regex' => 'Le nom doit être entre 1-32 caracteres et ne doit pas contenir de caracteres spéciaux.',
            'fonction.personne_ressource.regex' => 'La fonction de la personne doit être entre 1-32 caracteres et ne doit pas contenir de caracteres spéciaux.',
            'email_contact.personne_ressource.regex' => 'L\'adresse courriel doit être valide de format email@email.com',
            'email_contact.personne_ressource.max' => 'L\'adresse courriel doit être de 64 caractère ou moins.',
            'no_tel.personne_ressource.regex' => 'Le numéro de téléphone ne doit être composé que de chiffres.',
            'poste_tel.personne_ressource.regex' => 'Le numéro de téléphone ne doit être composé que de chiffres.',
            'poste_tel.personne_ressource.max' => 'Le numéro de téléphone doit être des chiffres.',
            'fichiers.file' => 'Le fichier doit être un fichier.',
            'fichiers.mimes' => 'extention de fichier incorrect*.',
        ];
    }
}
