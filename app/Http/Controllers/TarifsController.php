<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Tarifs;
use Illuminate\Http\Request;

class TarifsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère les tarifs avec la classe associée
        $tarifs = Tarifs::with('classe')->get();
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On a besoin des classes pour les lier au tarif
        $classes = Classe::all();
        return view('tarifs.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0',
            'mensualite'  => 'required|numeric|min:0',
            'classe_id'   => 'required|exists:classes,id',
        ]);

        Tarifs::create($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif configuré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarifs $tarifs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarifs $tarifs)
    {
        $classes = Classe::all();
        return view('tarifs.edit', compact('tarif', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarifs $tarifs)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0',
            'mensualite'  => 'required|numeric|min:0',
            'classe_id'   => 'required|exists:classes,id',
        ]);

        $tarifs->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarifs $tarifs)
    {
        $tarifs->delete();
        return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé');
    }
}
