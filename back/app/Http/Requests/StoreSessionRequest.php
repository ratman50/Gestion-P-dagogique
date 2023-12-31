<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            "course_id"=>"exists:courses,id|required",
            "date"=>"date|required",
            "salle_id"=>["exists:salles,id","required", new \App\Rules\SalleRule],
            "heure_deb"=>"required|numeric|between:8,17",
            "heure_fin"=>"required|numeric|after:heure_deb|between:8,17"
        ];
    }
}
