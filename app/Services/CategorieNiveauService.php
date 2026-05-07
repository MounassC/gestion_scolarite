<?php

namespace App\Services;

use App\Models\CategorieNiveaux;
use Exception;

class CategorieNiveauService
{
    public function store(array $data)
    {
        return CategorieNiveaux::create($data);
    }

    public function update(CategorieNiveaux $categorie, array $data)
    {
        return $categorie->update($data);
    }

    public function destroy(CategorieNiveaux $categorie)
    {
        // Règle métier : On ne supprime pas si des niveaux y sont rattachés
        if ($categorie->niveaux()->exists()) {
            throw new Exception("Impossible de supprimer : cette catégorie contient des niveaux (L1, L2, etc.).");
        }
        return $categorie->delete();
    }
}
