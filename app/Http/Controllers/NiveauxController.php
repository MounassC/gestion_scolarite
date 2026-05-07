<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;
use App\Models\CategorieNiveaux;
use App\Models\Niveau;
use App\Services\NiveauService;
use Illuminate\Http\Request;

class NiveauxController extends Controller
{
    protected $niveauService;

    public function __construct(NiveauService $niveauService)
    {
        $this->niveauService = $niveauService;
    }


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
    public function store(StoreNiveauRequest $request)
    {
        $this->niveauService->store($request->validated());
        return redirect()->route('niveaux.index')->with('success', 'Niveau créé avec succès !');
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
    public function update(UpdateNiveauRequest $request, Niveau $niveau)
    {
        try {
            // On essaie de mettre à jour via le service
            $this->niveauService->update($niveau, $request->validated());

            return redirect()->route('niveaux.index')->with('success', 'Niveau mis à jour !');
        } catch (\Exception $e) {
            // Si le service lance une Exception (comme sur ton image), 
            // on l'attrape ici et on redirige vers la page précédente avec le message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        try {
            $this->niveauService->destroy($niveau);
            return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
