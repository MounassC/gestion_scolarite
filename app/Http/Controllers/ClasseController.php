<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On utilise eager loading (with) pour la performance
        $classes = Classe::with(['filiere', 'niveau'])->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On récupère les listes pour remplir les <select> du formulaire
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        return view('classes.create', compact('filieres', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_classe'  => 'required|string|max:255',
            'code_classe' => 'required|unique:classes,code_classe',
            'filiere_id'  => 'required|exists:filieres,id',
            'niveau_id'   => 'required|exists:niveaux,id',
        ]);

        Classe::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class)
    {
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        return view('classes.edit', compact('class', 'filieres', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $class)
    {
        $request->validate([
            'nom_classe'  => 'required|string|max:255',
            'code_classe' => 'required|unique:classes,code_classe,' . $class->id,
            'filiere_id'  => 'required|exists:filieres,id',
            'niveau_id'   => 'required|exists:niveaux,id',
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classes.index')->with('success', 'Classe supprimée');
    }
}
