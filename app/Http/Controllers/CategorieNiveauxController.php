<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieNiveauRequest;
use App\Http\Requests\UpdateCategorieNiveauRequest;
use App\Models\CategorieNiveaux;
use App\Services\CategorieNiveauService;
use Exception;
use Illuminate\Http\Request;

class CategorieNiveauxController extends Controller
{

    protected $service;

    public function __construct(CategorieNiveauService $service)
    {
        $this->service = $service;
    }

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

    public function store(StoreCategorieNiveauRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès');
    }

    // Dans Laravel, par défaut, le paramètre sera 'categorie_niveau' (au singulier)
    public function edit(CategorieNiveaux $categorie_niveau)
    {
        // Utilisation du Model Binding direct (plus propre que findOrFail)
        return view('categorie_niveaux.edit', compact('categorie_niveau'));
    }

    public function update(UpdateCategorieNiveauRequest $request, CategorieNiveaux $categorie_niveau)
    {
        try {
            $this->service->update($categorie_niveau, $request->validated());
            return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(CategorieNiveaux $categorie_niveau)
    {
        try {
            $this->service->destroy($categorie_niveau);
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
