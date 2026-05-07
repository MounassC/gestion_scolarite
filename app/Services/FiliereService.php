<?php

namespace App\Services;

use App\Models\Filiere;
use Exception;

class FiliereService
{
    public function store(array $data)
    {
        return Filiere::create($data);
    }

    public function update(Filiere $filiere, array $data)
    {
        return $filiere->update($data);
    }

    public function destroy(Filiere $filiere)
    {
        // Vérification : Est-ce que cette filière est utilisée par des classes ?
        if ($filiere->classes()->exists()) {
            throw new Exception("Impossible de supprimer : cette filière est liée à des classes existantes.");
        }
        return $filiere->delete();
    }
}
