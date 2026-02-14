<?php

namespace App\Http\Controllers;

use App\Models\CategorieNiveaux;
use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::with('categorie_niveau')->get();
        return view('niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategorieNiveaux::all();
        return view('niveaux.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom_niveaux' => 'required',
        // Vérifie bien que le nom de la table est 'categorie_niveaux'
        'categorie_niveau_id' => 'required|exists:categorie_niveaux,id' 
    ]);

    Niveau::create($request->all());

    return redirect()->route('niveaux.index')->with('success', 'Niveau créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        $categories = CategorieNiveaux::all();
        return view('niveaux.edit', compact('niveau', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'nom_niveaux' => 'required|string|max:255',
            'categorie_niveau_id' => 'required|exists:categorie_niveaux,id'
        ]);

        $niveau->update($request->all());

        return redirect()->route('niveaux.index')->with('success', 'Niveau mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();
        return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé');
    }
}
