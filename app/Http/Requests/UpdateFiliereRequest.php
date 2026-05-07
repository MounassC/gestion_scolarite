<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFiliereRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // On peut ajouter une logique d'autorisation ici si nécessaire
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // On récupère l'ID de la filière depuis la route pour l'exception d'unicité
        $filiereId = $this->route('filiere')->id;

        return [
            'code'       => 'required|unique:filieres,code,' . $filiereId,
            'nomFiliere' => 'required|unique:filieres,nomFiliere,' . $filiereId
        ];
    }
}
