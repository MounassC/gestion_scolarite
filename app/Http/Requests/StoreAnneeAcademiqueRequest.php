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
            'code' => 'required|string|unique:annee_academiques,code',

            // L'école doit ouvrir avant de fermer
            'dateOuverture' => 'required|date',
            'dateFermeture' => 'required|date|after:dateOuverture',

            // Début inscription AVANT fin inscription
            'dateDebutInscription' => 'required|date|before:dateFinInscription',
            'dateFinInscription' => 'required|date',

            // Contrainte prof : L'ouverture des inscriptions doit être AVANT l'ouverture de l'école
            'dateDebutInscription' => 'required|date|before:dateOuverture',

            // Contrainte prof : La fermeture des inscriptions doit être APRÈS l'ouverture de l'école
            'dateFinInscription' => 'required|date|after:dateOuverture',
        ];
    }

    /**
     * Optionnel : Personnaliser les messages d'erreur en français
     */
    public function messages(): array
    {
        return [
            'dateDebutInscription.before' => "La date de début d'inscription doit être antérieure à la date de fin.",
            'dateDebutInscription.before' => "Les inscriptions doivent commencer avant l'ouverture de l'école.",
            'dateFinInscription.after' => "Les inscriptions doivent se terminer après l'ouverture de l'école.",
            'dateFermeture.after' => "La date de fermeture doit être après la date d'ouverture.",
        ];
    }
}
