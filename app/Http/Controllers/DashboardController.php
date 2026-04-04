<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Tarif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. On récupère l'année active (Celle ouverte ou la toute dernière créée)
        $anneeActive = \App\Models\AnneeAcademique::where('statut', 'ouvertureInscription')
            ->latest()
            ->first()
            ?? \App\Models\AnneeAcademique::latest()->first();

        // 2. Tes comptes actuels
        $countClasses = Classe::count();
        $countTarifs = Tarif::count();
        $countFilieres = Filiere::count();

        // 3. Tes classes récentes
        $recentClasses = Classe::with(['filiere', 'niveau'])->latest()->take(5)->get();

        // 4. On ajoute 'anneeActive' dans le compact
        return view('dashboard', compact(
            'countClasses',
            'countTarifs',
            'countFilieres',
            'recentClasses',
            'anneeActive'
        ));
    }
}
