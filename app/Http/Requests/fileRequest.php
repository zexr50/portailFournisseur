<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class fileRequest extends FormRequest
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
            'fichiers' => 'nullable|file|mimes:jpeg,png,gif,svg,bmp,pdf,txt,doc,docx,xls,xlsx,ppt,pptx',
        ];

        return $rules;
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
            'fichiers.file' => 'Le fichier doit être un fichier.',
            'fichiers.mimes' => 'extention de fichier incorrect*.',
        ];
    }

}
