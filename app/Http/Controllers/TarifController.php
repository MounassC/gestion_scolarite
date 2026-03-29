<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Tarif;
use App\Models\TarifClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inscription' => 'required|numeric',
            'mensualite' => 'required|numeric',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif créé avec succès.');
    }

    // --- LOGIQUE DE RATTACHEMENT ---

    // Affiche le formulaire pour lier un Tarif à une Classe
    public function showRattacher()
    {
        $classes = Classe::all();
        $tarifs = Tarif::all();
        return view('tarifs.rattacher', compact('classes', 'tarifs'));
    }

    public function storeRattacher(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'tarif_id' => 'required|exists:tarifs,id',
        ]);

        // Utilisation d'une Transaction pour sécuriser l'opération
        DB::transaction(function () use ($request) {
            // 1. Désactiver tous les anciens tarifs de cette classe précise
            TarifClasse::where('classe_id', $request->classe_id)
                        ->update(['is_active' => false]);

            // 2. Créer la nouvelle liaison active
            TarifClasse::create([
                'classe_id' => $request->classe_id,
                'tarif_id' => $request->tarif_id,
                'is_active' => true,
            ]);
        });

        return redirect()->route('classes.index')->with('success', 'Le tarif a été mis à jour pour cette classe.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarifs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarifs)
    {
        $classes = Classe::all();
        return view('tarifs.edit', compact('tarif', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarifs)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0',
            'mensualite'  => 'required|numeric|min:0',
        ]);

        $tarifs->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarifs)
    {
        $tarifs->delete();
        return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé');
    }
}
