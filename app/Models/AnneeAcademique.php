<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    use HasFactory;

    protected $table = 'annee_academiques';
    protected $fillable = [
        'code',
        'dateOuverture',
        'dateFermeture',
        'dateDebutInscription',
        'dateFinInscription',
        'statut'
    ];

    /**
     * Passer de Brouillon à Publié
     */
    public function publier()
    {
        if ($this->statut !== 'brouillon') {
            throw new Exception("Le statut actuel ne permet pas de publier l'année.");
        }
        $this->statut = 'publie';
        $this->save();
    }

    /**
     * Passer de Publié à Ouverture Inscription
     */
    public function ouvrirInscriptions()
    {
        if ($this->statut !== 'publie') {
            throw new Exception("Le statut actuel ne permet pas d'ouvrir les inscriptions.");
        }
        $this->statut = 'ouvertureInscription';
        $this->save();
    }

    /**
     * 3. Ouverture Inscription -> Fermeture Inscription
     */
    public function fermerInscriptions()
    {
        if ($this->statut !== 'ouvertureInscription') {
            throw new Exception("Impossible de fermer : les inscriptions ne sont pas en cours (Ouverture Inscription attendue).");
        }
        $this->statut = 'fermetureInscription';
        $this->save();
    }

    /**
     * 4. Fermeture Inscription -> Clôture
     */
    public function cloturer()
    {
        if ($this->statut === 'cloture') {
            throw new Exception("Cette année est déjà clôturée.");
        }

        // Optionnel : On peut forcer le passage par 'fermetureInscription' avant de clôturer
        if ($this->statut !== 'fermetureInscription') {
            throw new Exception("L'année doit être en 'Fermeture Inscription' avant d'être clôturée.");
        }

        $this->statut = 'cloture';
        $this->save();
    }
}
