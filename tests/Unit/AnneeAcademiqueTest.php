<?php

namespace Tests\Unit;

use App\Services\AnneeAcademiqueService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AnneeAcademiqueTest extends TestCase
{
    use RefreshDatabase; // Vide la base de données de test à chaque essai

    #[Test]
    public function une_annee_academique_peut_etre_creee_avec_succes()
    {
        // 1. ARRANGEMENT (Préparation) : On instancie le service et les données valides
        $service = new AnneeAcademiqueService();
        $data = [
            'code' => '2025-2026',
            'dateOuverture' => '2025-10-01',
            'dateFermeture' => '2026-06-01', // Durée de 9 mois exacte
            'dateDebutInscription' => '2025-09-01',
            'dateFinInscription' => '2025-10-15',
        ];

        // 2. ACTION : On exécute la méthode store du service
        $annee = $service->store($data);

        // 3. ASSERTION (Vérification) : On vérifie que les données sont bien en base
        // On teste si le statut a été forcé à 'brouillon' par le service (règle métier)
        $this->assertDatabaseHas('annee_academiques', [
            'code' => '2025-2026',
            'statut' => 'brouillon'
        ]);

        // On vérifie que l'objet retourné contient les bonnes informations
        $this->assertEquals('2025-2026', $annee->code);
    }

    #[Test]
    public function on_ne_peut_pas_sauter_l_etape_de_publication()
    {
        $service = new AnneeAcademiqueService();

        // On crée d'abord une année en brouillon (statut par défaut)
        $annee = $service->store([
            'code' => '2026-2027',
            'dateOuverture' => '2026-10-01',
            'dateFermeture' => '2027-06-01',
            'dateDebutInscription' => '2026-09-01',
            'dateFinInscription' => '2026-10-15',
        ]);

        // On définit l'exception attendue : si le service ne lance pas d'Exception, le test échoue.
        // Cette règle empêche de passer de 'brouillon' à 'ouvert' directement.
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("L'année doit être publiée avant d'ouvrir les inscriptions.");

        // Tentative d'ouverture immédiate (devrait déclencher l'exception ci-dessus)
        $service->ouvrirInscriptions($annee);
    }

    #[Test]
    public function la_duree_de_lannee_academique_doit_etre_egale_a_neuf_mois()
    {
        $service = new AnneeAcademiqueService();

        // On teste le calcul avec des dates personnalisées (Novembre à Juillet)
        $annee = $service->store([
            'code' => '2013-9MOIS',
            'dateOuverture' => '2013-11-15',
            'dateFermeture' => '2014-07-24',
            'dateDebutInscription' => '2013-10-01',
            'dateFinInscription' => '2013-11-01',
        ]);

        // Extraction des dates pour vérification manuelle dans le test
        $dateDebut = Carbon::parse($annee->dateOuverture);
        $dateFin = Carbon::parse($annee->dateFermeture);

        /**
         * Logique de calcul identique au Service : 
         * On calcule le nombre de mois révolus entre les deux années, 
         * on ajoute l'écart de mois, et +1 pour inclure le mois de départ.
         */
        $dureeEnMois = (($dateFin->year - $dateDebut->year) * 12) + ($dateFin->month - $dateDebut->month) + 1;

        $this->assertEquals(9, $dureeEnMois);
    }

    #[Test]
    public function une_annee_ne_peut_pas_etre_differente_de_neuf_mois()
    {
        $service = new AnneeAcademiqueService();

        // Préparation de données invalides (Janvier à Décembre = 12 mois)
        $data = [
            'code' => '2025-12MOIS',
            'dateOuverture' => '2025-01-01',
            'dateFermeture' => '2025-12-01',
            'dateDebutInscription' => '2024-12-01',
            'dateFinInscription' => '2025-01-15',
        ];

        // On s'attend à ce que le service refuse la création
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("L'année académique doit durer exactement 9 mois.");

        // Cette action doit faire "exploser" le test (Exception), ce qui est le comportement voulu ici.
        $service->store($data);
    }
}
