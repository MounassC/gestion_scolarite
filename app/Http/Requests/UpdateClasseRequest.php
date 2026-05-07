<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClasseRequest extends FormRequest
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
            'nom_classe'  => 'required|string|max:255',
            'code_classe' => 'required|unique:classes,code_classe,' . $this->route('class')->id, // Attention au nom de la variable dans la route
            'filiere_id'  => 'required|exists:filieres,id',
            'niveau_id'   => 'required|exists:niveaux,id',
        ];
    }
}
