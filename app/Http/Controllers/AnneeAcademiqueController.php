<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class AnneeAcademiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annees = AnneeAcademique::all();
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
    public function store(Request $request)
    {
        $request->validate([
            'anneeAc' => 'required|unique:annee_academiques,anneeAc'
        ]);

        AnneeAcademique::create($request->all());
        return redirect()->route('annees.index')->with('success', 'Année académique ajoutée');
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
        return view('annees.edit', compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnneeAcademique $annee)
    {
        $request->validate([
            'anneeAc' => 'required|unique:annee_academiques,anneeAc,' . $annee->id
        ]);

        $annee->update($request->all());
        return redirect()->route('annees.index')->with('success', 'Année académique mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeAcademique $annee)
    {
        $annee->delete();
        return redirect()->route('annees.index')->with('success', 'Année académique supprimée');
    }
}
