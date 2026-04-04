<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnneeAcademiqueRequest;
use App\Models\AnneeAcademique;
use Exception;


class AnneeAcademiqueController extends Controller
{
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
        // On utilise les données déjà validées par StoreAnneeAcademiqueRequest
        $data = $request->validated();

        // On s'assure que le statut est bien 'brouillon' à la création
        $data['statut'] = 'brouillon';

        AnneeAcademique::create($data);

        return redirect()->route('annees.index')->with('success', 'Année académique ajoutée avec succès.');
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
        // si c'est publié ou plus, on ne peut plus modifier
        if ($annee->statut !== 'brouillon') {
            return redirect()->route('annees.index')->with('error', 'Cette année ne peut plus être modifiée car elle est déjà publiée.');
        }
        return view('annees.edit', compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnneeAcademiqueRequest $request, AnneeAcademique $annee)
    {
        if ($annee->statut !== 'brouillon') {
            return redirect()->route('annees.index')->with('error', 'Modification impossible.');
        }

        $annee->update($request->validated());
        return redirect()->route('annees.index')->with('success', 'Année mise à jour.');
    }

    /**
     * Nouvelle méthode pour PUBLIER
     */
    public function publier(AnneeAcademique $annee)
    {
        try {
            $annee->publier(); // On appelle la logique du modèle
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
            $annee->ouvrirInscriptions(); // On appelle la logique du modèle
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
            $annee->fermerInscriptions();
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
            $annee->cloturer();
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
        if ($annee->statut !== 'brouillon') {
            return redirect()->back()->with('error', 'Impossible de supprimer une année déjà publiée.');
        }
        $annee->delete();
        return redirect()->route('annees.index')->with('success', 'Année supprimée.');
    }
}
