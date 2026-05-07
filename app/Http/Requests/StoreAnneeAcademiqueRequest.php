<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnneeAcademiqueRequest extends FormRequest
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
            'code' => 'required|string|unique:annee_academiques,code,' . ($this->annee->id ?? ''),
            'dateOuverture' => 'required|date',
            'dateFermeture' => 'required|date|after:dateOuverture',

            // Inscriptions : doivent commencer avant l'ouverture et finir après l'ouverture
            'dateDebutInscription' => 'required|date|before:dateFinInscription|before:dateOuverture',
            'dateFinInscription' => 'required|date|after:dateOuverture',
        ];
    }

    /**
     * Optionnel : Personnaliser les messages d'erreur en français
     */
    public function messages(): array
    {
        return [
            'code.unique' => "Ce code d'année académique existe déjà.",
            'dateFermeture.after' => "La date de fermeture doit être après la date d'ouverture.",
            'dateDebutInscription.before' => "Les inscriptions doivent commencer avant l'ouverture de l'école.",
            'dateFinInscription.after' => "Les inscriptions doivent se terminer après le début des cours.",
        ];
    }
}
