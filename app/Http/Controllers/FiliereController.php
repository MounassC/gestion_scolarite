<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;
use App\Models\Filiere;
use App\Services\FiliereService;
use Illuminate\Http\Request;

class FiliereController extends Controller
{

    protected $filiereService;

    public function __construct(FiliereService $filiereService)
    {
        $this->filiereService = $filiereService;
    }

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
    public function store(StoreFiliereRequest $request)
    {
        $this->filiereService->store($request->validated());
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
    public function update(UpdateFiliereRequest $request, Filiere $filiere)
    {
        $this->filiereService->update($filiere, $request->validated());
        return redirect()->route('filieres.index')->with('success', 'Filière modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        try {
            $this->filiereService->destroy($filiere);
            return redirect()->route('filieres.index')->with('success', 'Filière supprimée avec succès');
        } catch (\Exception $e) {
            return redirect()->route('filieres.index')->with('error', $e->getMessage());
        }
    }
}
