<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filieres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:filieres,code',
            'nomFiliere' => 'required|unique:filieres,nomFiliere'
        ]);

        Filiere::create([
            'code' => $request->code,
            'nomFiliere' => $request->nomFiliere,
        ]);

        return redirect()->route('filieres.index')->with('success', 'Filière ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'code' => 'required|unique:filieres,code,' . $filiere->id,
            'nomFiliere' => 'required|unique:filieres,nomFiliere,' . $filiere->id
        ]);

        $filiere->update($request->all());

        return redirect()->route('filieres.index')->with('success', 'Filière modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filière supprimée');
    }
}
