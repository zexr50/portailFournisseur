<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class TestRequest extends FormRequest
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
            'file.*' => 'nullable|file|mimetypes:
            image/jpeg, image/png, image/gif, image/svg+xml, image/bmp,
            application/pdf,text/plain,application/msword, 
            application/vnd.openxmlformats-officedocument.wordprocessingml.document,
            application/vnd.ms-excel, 
            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
            application/vnd.ms-powerpoint, 
            application/vnd.openxmlformats-officedocument.presentationml.presentation',
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
            
        ];
    }
}
