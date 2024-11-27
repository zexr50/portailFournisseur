<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateSingleFieldRequest extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        Log::error('Validation failed', $validator->errors()->toArray());
        parent::failedValidation($validator);
    }

    public function rules(): array
    {
        $type = $this->input('TypeInfo');

        $fieldRules = [
            'mdp' => 'required|string|max:15|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,12}$/',
            'mdp_confirmation' => 'required|string|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,12}$/',
            'no_rue' => 'required|string|max:8|regex:/^[0-9]{1,8}$/',
            'rue' => 'required|string|max:64|regex:/^[a-zA-ZÀ-ÿ0-9\s’‘-]+(?:\s[a-zA-ZÀ-ÿ0-9\s’‘-]+)*$/',
            'no_bureau' => 'nullable|string|max:16|regex:/^[0-9]{1,16}$/',
            'ville' => 'required|string|max:64|regex:/^[a-zA-ZÀ-ÿ0-9\s’‘-]+(?:\s[a-zA-ZÀ-ÿ0-9\s’‘-]+)*$/',
            'province' => 'required|string|in:Quebec,Alberta,Colombie-Britannique,Ile-du-Prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Ecosse,Ontario,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon', 
            'no_region_admin' => 'required|string|in:00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17',
            'code_postal' => 'required|string|max:8|regex:/^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i',
            'site_internet' => 'nullable|string|max:64|regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9\-]+(\.[a-zA-Z]{2,})+)(\/[^\s]*)?$/',
            'commentaire' => 'nullable|string|max:500|regex:/^[a-zA-ZÀ-ÿ0-9\s’‘-]+(?:\s[a-zA-ZÀ-ÿ0-9\s’‘-]+)*$/',
            
            'fonction' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9](?:[a-zA-Z0-9 ]*[a-zA-Z0-9])?$/',
            'type_tel' => 'nullable|string|in:bureau,cellulaire,fax',
            'no_tel' => 'nullable|string|max:20|regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,3}\)?[-.\s]?)?(\d{3,4}[-.\s]?)?\d{3,4}$/',
            'poste_tel' => 'nullable|string|max:10|regex:/^[0-9]+$/',
            'prenom_contact' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{1,32}$/',
            'nom.personne_ressource' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{1,32}$/',
            'nom_contact' => 'nullable|string|max:32|regex:/^[a-zA-Z0-9]{1,32}$/',
            'email_contact' => 'nullable|string|max:32|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,}$/',
            'type_tel' => 'nullable|string|in:bureau,cellulaire,fax',
            'no_tel' => 'nullable|string|max:15|regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,3}\)?[-.\s]?)?(\d{3,4}[-.\s]?)?\d{3,4}$/',
            'poste_tel' => 'nullable|string|max:10|regex:/^[0-9]+$/',

        ];
        return [
            'Info' => $fieldRules[$type] ?? 'nullable', 
            'TypeInfo' => 'required|string|in:' . implode(',', array_keys($fieldRules)),
        ];
    }
}
