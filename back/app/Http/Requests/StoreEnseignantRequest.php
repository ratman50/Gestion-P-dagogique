<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnseignantRequest extends FormRequest
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
            "grade"=>'required',
            "nom"=>'required',
            "prenom"=>'required',
            "specialite"=>'required',
            "module"=>'required|array',
            "email"=>'required|email',
            "module.*"=>'exists:modules,id'
        ];
    }
}
