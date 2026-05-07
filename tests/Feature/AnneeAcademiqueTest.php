<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\AnneeAcademique;
use PHPUnit\Framework\Attributes\Test;

class AnneeAcademiqueTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function une_annee_academique_peut_etre_creee_si_elle_dure_9_mois()
    {
        // 1. Préparation des données (Octobre à Juin = 9 mois)
        $donnees = [
            'code' => 'ANNEE-' . uniqid(),
            'dateOuverture' => '2025-10-01',
            'dateFermeture' => '2026-06-01',
            'dateDebutInscription' => '2025-09-01', // Avant l'ouverture
            'dateFinInscription' => '2025-10-15',   // Après l'ouverture
        ];

        // 2. Action
        // On simule venir de la page de création pour que les erreurs éventuelles 
        // redirigent au bon endroit et facilitent le debug.
        $response = $this->from(route('annees.create'))
            ->post(route('annees.store'), $donnees);

        // 3. Vérifications

        // A. Vérifie la redirection vers l'index (Succès)
        $response->assertRedirect(route('annees.index'));

        // B. Vérifie le message de succès en session
        $response->assertSessionHas('success', 'Année créée avec succès.');

        // C. Vérifie que les données sont bien présentes en base
        $this->assertDatabaseHas('annee_academiques', [
            'code' => $donnees['code'],
            'statut' => 'brouillon'
        ]);
    }

    #[Test]
    public function la_creation_echoue_si_la_date_debut_est_superieure_a_la_date_fin()
    {
        // 1. Préparation de données incohérentes
        $donnees = [
            'code' => '2025-2026-ERR',
            'dateOuverture' => '2026-06-01', // Début en juin 2026
            'dateFermeture' => '2025-10-01', // Fin en octobre 2025 (Inversé !)
            'dateDebutInscription' => '2025-09-01',
            'dateFinInscription' => '2025-11-01',
        ];

        // 2. Action
        $response = $this->post(route('annees.store'), $donnees);

        // 3. Vérifications

        // On vérifie que la validation a bloqué la requête (redirection vers le formulaire)
        // Laravel redirige automatiquement vers la page précédente en cas d'erreur de validation
        $response->assertStatus(302);

        // On vérifie que les erreurs de validation sont présentes pour le champ dateFermeture
        $response->assertSessionHasErrors(['dateFermeture']);

        // Preuve ultime : rien n'a été créé en base de données
        $this->assertDatabaseMissing('annee_academiques', [
            'code' => '2025-2026-ERR'
        ]);
    }

    #[Test]
    public function la_creation_echoue_si_la_duree_est_differente_de_9_mois()
    {
        $donnees = [
            'code' => '2025-SHORT',
            'dateOuverture' => '2025-10-01',
            'dateFermeture' => '2026-02-01', // Trop court
            'dateDebutInscription' => '2025-09-01',
            'dateFinInscription' => '2025-11-01',
        ];

        $response = $this->from(route('annees.create')) // Ajoute ça pour aider la redirection
            ->post(route('annees.store'), $donnees);

        $response->assertStatus(302);

        // ICI : Le message doit être EXACTEMENT celui du service
        $response->assertSessionHas('error', "L'année académique doit durer exactement 9 mois.");

        $this->assertDatabaseMissing('annee_academiques', [
            'code' => '2025-SHORT'
        ]);
    }

    #[Test]
    public function la_creation_echoue_si_le_code_existe_deja()
    {
        // 1. ARRANGEMENT : On crée une première année en base de données
        $codeExistant = 'ANNEE-2025';
        AnneeAcademique::create([
            'code' => $codeExistant,
            'dateOuverture' => '2025-10-01',
            'dateFermeture' => '2026-06-01',
            'dateDebutInscription' => '2025-09-01',
            'dateFinInscription' => '2025-10-15',
            'statut' => 'brouillon'
        ]);

        // 2. ACTION : On tente de créer une deuxième année avec le MÊME code
        $donneesDoublon = [
            'code' => $codeExistant, // C'est ici que ça doit bloquer
            'dateOuverture' => '2026-10-01',
            'dateFermeture' => '2027-06-01',
            'dateDebutInscription' => '2026-09-01',
            'dateFinInscription' => '2026-10-15',
        ];

        $response = $this->from(route('annees.create'))
            ->post(route('annees.store'), $donneesDoublon);

        // 3. ASSERTIONS (Vérifications)

        // On vérifie qu'on est redirigé (code 302)
        $response->assertStatus(302);

        // On vérifie que l'erreur de validation est bien présente pour le champ 'code'
        $response->assertSessionHasErrors(['code']);

        // On vérifie le message d'erreur personnalisé que tu as défini dans ton Request
        $errors = session('errors');
        $this->assertEquals(
            "Ce code d'année académique existe déjà.",
            $errors->get('code')[0]
        );
    }
}
