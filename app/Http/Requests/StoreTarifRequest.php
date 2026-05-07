<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTarifRequest extends FormRequest
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
        // Récupère l'ID du tarif en cas de modification pour ignorer son propre doublon
        $tarifId = $this->route('tarif') ? $this->route('tarif')->id : null;

        return [
            'inscription' => [
                'required',
                'numeric',
                'min:0',
                // Règle d'unicité combinée
                Rule::unique('tarifs')->where(function ($query) {
                    return $query->where('inscription', $this->inscription)
                        ->where('mensualite', $this->mensualite);
                })->ignore($tarifId),
                // Règle métier : Doit être supérieure à la mensualité
                'gte:mensualite',
            ],
            'mensualite' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'inscription.unique' => 'Ce tarif (Inscription + Mensualité) existe déjà dans le système.',
            'inscription.gte'    => 'Le montant de l\'inscription doit être supérieur ou égal à la mensualité.',
            'inscription.min' => 'Le montant ne peut pas être négatif.',
            'mensualite.min' => 'La mensualité ne peut pas être négative.',
            'inscription.numeric' => 'Saisissez un nombre valide.',
            'mensualite.numeric' => 'Saisissez un nombre valide.',
        ];
    }
}
