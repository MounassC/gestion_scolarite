<?php

namespace App\Http\Controllers;

use App\Models\CategorieNiveaux;
use Illuminate\Http\Request;

class CategorieNiveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategorieNiveaux::all();
        return view('categorie_niveaux.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorie_niveaux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie_niveau' => 'required|unique:categorie_niveaux,categorie_niveau'
        ]);
        CategorieNiveaux::create($request->all());
        return redirect()->route('categorie.index')->with('success', 'Catégorie créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategorieNiveaux $categorieNiveaux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategorieNiveaux $category)
    {
        return view('categorie_niveaux.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategorieNiveaux $category)
    {
        $request->validate([
            // On ignore l'ID actuel pour la règle "unique" lors de la modification
            'categories_niveau' => 'required|unique:categorie_niveaux,categories_niveau,' . $category->id
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategorieNiveaux $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée');
        } catch (\Exception $e) {
            // Sécurité au cas où la catégorie est liée à des niveaux existants
            return redirect()->route('categories.index')->with('error', 'Impossible de supprimer : cette catégorie est utilisée par des niveaux.');
        }
    }
}
