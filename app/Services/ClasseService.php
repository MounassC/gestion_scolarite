<?php

namespace App\Services;

use App\Models\Classe;
use Exception;

class ClasseService
{
    public function store(array $data)
    {
        // 1. Force le code en MAJUSCULES
        $data['code_classe'] = strtoupper($data['code_classe']);

        // 2. Vérification de l'unicité du Code (Clé unique métier)
        if (Classe::where('code_classe', $data['code_classe'])->exists()) {
            throw new Exception("Le code classe '{$data['code_classe']}' est déjà utilisé.");
        }

        // 3. Unicité Nom + Niveau + Filière (pour éviter les doublons de saisie)
        $doublon = Classe::where('nom_classe', $data['nom_classe'])
            ->where('niveau_id', $data['niveau_id'])
            ->where('filiere_id', $data['filiere_id'])
            ->exists();

        if ($doublon) {
            throw new Exception("Cette classe existe déjà pour ce niveau et cette filière.");
        }

        return Classe::create($data);
    }

    /**
     * Règle Métier : On ne peut pas activer une classe sans tarif
     */
    /*public function activer(Classe $classe)
    {
        // On vérifie si la relation tarifActif renvoie quelque chose
        // (En utilisant la méthode que tu as définie dans ton modèle)
        if ($classe->tarifActif()->count() === 0) {
            throw new Exception("Impossible d'activer la classe : aucun tarif actif n'est lié.");
        }

        return $classe->update(['is_active' => true]);
    } */

    public function update(Classe $classe, array $data)
    {
        if (isset($data['code_classe'])) {
            $data['code_classe'] = strtoupper($data['code_classe']);

            // Vérifier l'unicité du code si on le change (en excluant la classe actuelle)
            $existe = Classe::where('code_classe', $data['code_classe'])
                ->where('id', '!=', $classe->id)
                ->exists();
            if ($existe) {
                throw new Exception("Ce code classe est déjà utilisé par une autre classe.");
            }
        }

        return $classe->update($data);
    }

    public function destroy(Classe $classe)
    {
        // On empêche la suppression si des tarifs y ont été attachés (historique financier)
        if ($classe->tarifs()->exists()) {
            throw new Exception("Cette classe est liée à des tarifs. Supprimez les liens avant de supprimer la classe.");
        }

        return $classe->delete();
    }
}
