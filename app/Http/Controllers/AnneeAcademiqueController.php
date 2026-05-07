<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnneeAcademiqueRequest;
use App\Models\AnneeAcademique;
use App\Services\AnneeAcademiqueService;
use Exception;
use Illuminate\Support\Facades\DB;

class AnneeAcademiqueController extends Controller
{

    protected $service;

    public function __construct(AnneeAcademiqueService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annees = AnneeAcademique::latest()->get();
        return view('annees.index', compact('annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('annees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeAcademiqueRequest $request)
    {
        try {
            $this->service->store($request->validated());
            return redirect()->route('annees.index')->with('success', 'Année créée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnneeAcademique $annee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeAcademique $annee)
    {
        // La vérification peut rester ici pour l'affichage de la vue
        if ($annee->statut !== 'brouillon') {
            return redirect()->route('annees.index')->with('error', 'Modification impossible : l\'année est déjà publiée.');
        }
        return view('annees.edit', compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnneeAcademiqueRequest $request, AnneeAcademique $annee)
    {
        try {
            $this->service->update($annee, $request->validated());
            return redirect()->route('annees.index')->with('success', 'Mise à jour réussie.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Nouvelle méthode pour PUBLIER
     */
    public function publier(AnneeAcademique $annee)
    {
        try {
            $this->service->publier($annee);
            return redirect()->back()->with('success', 'Année publiée avec succès !');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Nouvelle méthode pour OUVRIR LES INSCRIPTIONS
     */
    public function ouvrirInscriptions(AnneeAcademique $annee)
    {
        try {
            $this->service->ouvrirInscriptions($annee);
            return redirect()->back()->with('success', 'Inscriptions ouvertes !');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Nouvelle méthode pour FERMER LES INSCRIPTIONS
     */
    public function fermerInscriptions(AnneeAcademique $annee)
    {
        try {
            $this->service->fermerInscriptions($annee);
            return redirect()->back()->with('success', 'Inscriptions fermées avec succès !');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Nouvelle méthode pour CLOTURER L'ANNÉE
     */
    public function cloturer(AnneeAcademique $annee)
    {
        try {
            $this->service->cloturer($annee);
            return redirect()->back()->with('success', 'Année académique clôturée définitivement.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeAcademique $annee)
    {
        try {
            $this->service->destroy($annee);
            return redirect()->route('annees.index')->with('success', 'Année supprimée.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
