<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTarifRequest;
use App\Models\Classe;
use App\Models\Tarif;
use App\Models\TarifClasse;
use App\Services\TarifService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarifController extends Controller
{

    protected $tarifService;

    public function __construct(TarifService $tarifService)
    {
        $this->tarifService = $tarifService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère les tarifs en chargeant déjà la relation 'classes'
        // 'withCount' est encore plus léger : il récupère juste le nombre de classes liées
        $tarifs = Tarif::withCount('classes')->get();

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
    public function store(StoreTarifRequest $request)
    {
        $this->tarifService->createTarif($request->validated());
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

        try {
            $this->tarifService->rattacherAClasse($request->classe_id, $request->tarif_id);
            return redirect()->route('classes.index')->with('success', 'Nouveau tarif appliqué à la classe.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du rattachement : ' . $e->getMessage());
        }
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
    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTarifRequest $request, Tarif $tarif)
    {
        $this->tarifService->updateTarif($tarif, $request->validated());
        return redirect()->route('tarifs.index')->with('success', 'Tarif mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        try {
            $this->tarifService->deleteTarif($tarif);
            return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
