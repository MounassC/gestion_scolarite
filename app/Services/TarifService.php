<?php

namespace App\Services;

use App\Models\Tarif;
use App\Models\TarifClasse;
use Illuminate\Support\Facades\DB;
use Exception;

class TarifService
{
    public function createTarif(array $data)
    {
        return Tarif::create($data);
    }

    public function updateTarif(Tarif $tarif, array $data)
    {
        return $tarif->update($data);
    }

    public function deleteTarif(Tarif $tarif)
    {
        // Règle métier : On ne supprime pas un tarif utilisé par des classes
        if ($tarif->classes()->exists()) {
            throw new Exception("Impossible de supprimer ce tarif : il est actuellement lié à une ou plusieurs classes.");
        }
        return $tarif->delete();
    }

    /**
     * Gère le rattachement et l'historique des tarifs par classe
     */
    public function rattacherAClasse(int $classeId, int $tarifId)
    {
        return DB::transaction(function () use ($classeId, $tarifId) {
            // 1. On archive l'ancien tarif (is_active = false)
            TarifClasse::where('classe_id', $classeId)
                ->update(['is_active' => false]);

            // 2. On lie le nouveau tarif (ou on met à jour si la liaison existait déjà)
            return TarifClasse::updateOrCreate(
                ['classe_id' => $classeId, 'tarif_id' => $tarifId],
                ['is_active' => true]
            );
        });
    }
}