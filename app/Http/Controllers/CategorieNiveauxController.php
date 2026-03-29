<?php

namespace App\Http\Controllers;

use App\Models\CategorieNiveaux;
use Illuminate\Http\Request;

class CategorieNiveauxController extends Controller
{
    public function index()
    {
        $categories = CategorieNiveaux::all();
        // Vérifie bien que ton dossier s'appelle 'categorie_niveaux' et non 'categories'
        return view('categorie_niveaux.index', compact('categories'));
    }

    public function create()
    {
        return view('categorie_niveaux.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_niveau' => 'required|unique:categorie_niveaux,categorie_niveau'
        ]);
        
        CategorieNiveaux::create($request->all());
        
        // Correction : assure-toi que le nom de la route est correct (pluriel ou singulier)
        return redirect()->route('categorie_niveaux.index')->with('success', 'Catégorie créée');
    }

    // Dans Laravel, par défaut, le paramètre sera 'categorie_niveau' (au singulier)
    public function edit($id)
    {
        $category = CategorieNiveaux::findOrFail($id);
        return view('categorie_niveaux.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CategorieNiveaux::findOrFail($id);
        
        $request->validate([
            // Vérifie bien le nom de la colonne dans ta base (categorie_niveau sans 's' ?)
            'categorie_niveau' => 'required|unique:categorie_niveaux,categorie_niveau,' . $category->id
        ]);

        $category->update($request->all());

        return redirect()->route('categorie_niveaux.index')->with('success', 'Catégorie mise à jour');
    }

    public function destroy($id)
    {
        try {
            $category = CategorieNiveaux::findOrFail($id);
            $category->delete();
            return redirect()->route('categorie_niveaux.index')->with('success', 'Catégorie supprimée');
        } catch (\Exception $e) {
            return redirect()->route('categorie_niveaux.index')->with('error', 'Impossible de supprimer : cette catégorie est utilisée.');
        }
    }
}