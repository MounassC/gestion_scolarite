<?php

namespace App\Services;

use App\Models\Niveau;
use Exception;

class NiveauService
{
    public function store(array $data)
    {
        return Niveau::create($data);
    }

    public function update(Niveau $niveau, array $data)
    {
        // RÈGLE DE SÉCURITÉ :
        // Si le niveau est déjà utilisé par des classes, 
        // on peut éventuellement interdire toute modification 
        // pour éviter de corrompre l'historique scolaire.

        if ($niveau->classes()->exists()) {
            throw new Exception("Interdit : Ce niveau est déjà rattaché à des classes. Vous ne pouvez plus le modifier pour garantir l'intégrité des données.");
        }

        return $niveau->update($data);
    }

    public function destroy(Niveau $niveau)
    {
        // Règle métier : Vérifier les classes rattachées
        if ($niveau->classes()->exists()) {
            throw new Exception("Action impossible : Ce niveau est lié à des classes existantes.");
        }
        return $niveau->delete();
    }
}
