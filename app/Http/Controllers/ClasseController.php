<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Services\ClasseService;
use Exception;
use Illuminate\Http\Request;

class ClasseController extends Controller
{

    protected $classeService;

    // On injecte le service ici
    public function __construct(ClasseService $classeService)
    {
        $this->classeService = $classeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On utilise "with" pour charger les relations et éviter les erreurs
        $classes = Classe::with(['filiere', 'niveau', 'tarifActif'])->get();
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
    public function store(StoreClasseRequest $request)
    {
        try {
            $this->classeService->store($request->validated());
            return redirect()->route('classes.index')->with('success', 'Classe créée avec succès');
        } catch (Exception $e) {
            // En cas d'erreur métier (doublon, code existant), on revient au formulaire
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
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
    public function update(UpdateClasseRequest $request, Classe $class)
    {
        try {
            $this->classeService->update($class, $request->validated());
            return redirect()->route('classes.index')->with('success', 'Classe mise à jour');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $class)
    {
        try {
            $this->classeService->destroy($class);
            return redirect()->route('classes.index')->with('success', 'La classe a été supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
