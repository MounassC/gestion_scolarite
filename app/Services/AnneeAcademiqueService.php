<?php

namespace App\Services;

use App\Models\AnneeAcademique;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnneeAcademiqueService
{
    public function store(array $data)
    {
        $this->verifierDureeAnnee($data['dateOuverture'], $data['dateFermeture']);

        $data['statut'] = 'brouillon';
        return AnneeAcademique::create($data);
    }

    public function update(AnneeAcademique $annee, array $data)
    {
        // CONTRAINTE : Une fois publié ou plus, impossible de modifier (Lecture seule)
        if ($annee->statut !== 'brouillon') {
            throw new Exception("Cette année est en lecture seule. Seul un brouillon peut être modifié.");
        }

        $this->verifierDureeAnnee($data['dateOuverture'], $data['dateFermeture']);
        return $annee->update($data);
    }

    /**
     * Règle métier : L'année ne doit pas dépasser 9 mois
     */
    private function verifierDureeAnnee($debut, $fin)
    {
        $dateDebut = \Carbon\Carbon::parse($debut);
        $dateFin = \Carbon\Carbon::parse($fin);

        // On calcule la différence de mois absolue
        // (Année de fin - Année de début) * 12 + (Mois de fin - Mois de début) + 1
        $dureeEnMois = (($dateFin->year - $dateDebut->year) * 12) + ($dateFin->month - $dateDebut->month) + 1;

        if ($dureeEnMois !== 9) {
            throw new Exception("L'année académique doit durer exactement 9 mois.");
        }
    }
    public function publier(AnneeAcademique $annee)
    {
        // CONTRAINTE : Il faut être en brouillon pour publier
        if ($annee->statut !== 'brouillon') {
            throw new Exception("Le statut actuel ne permet pas de publier l'année.");
        }
        return $annee->update(['statut' => 'publie']);
    }

    public function ouvrirInscriptions(AnneeAcademique $annee)
    {
        // CONTRAINTE : Doit être "publie" pour passer à "ouvert"
        if ($annee->statut !== 'publie') {
            throw new Exception("L'année doit être publiée avant d'ouvrir les inscriptions.");
        }

        return DB::transaction(function () use ($annee) {
            // Sécurité : On ferme les inscriptions de toutes les autres années
            AnneeAcademique::where('statut', 'ouvert')->update(['statut' => 'ferme']);
            return $annee->update(['statut' => 'ouvert']);
        });
    }

    public function fermerInscriptions(AnneeAcademique $annee)
    {
        // CONTRAINTE : Doit être à "ouvert" avant de passer à "ferme"
        if ($annee->statut !== 'ouvert') {
            throw new Exception("Les inscriptions ne sont pas ouvertes, elles ne peuvent donc pas être fermées.");
        }
        return $annee->update(['statut' => 'ferme']);
    }

    public function cloturer(AnneeAcademique $annee)
    {
        // CONTRAINTE : On ne clôture que si c'était publié/ouvert/fermé (pas brouillon)
        if ($annee->statut === 'brouillon') {
            throw new Exception("Impossible de clôturer une année en mode brouillon.");
        }
        return $annee->update(['statut' => 'cloture']);
    }

    public function destroy(AnneeAcademique $annee)
    {
        if ($annee->statut !== 'brouillon') {
            throw new Exception("Impossible de supprimer une année déjà publiée.");
        }
        return $annee->delete();
    }
}
