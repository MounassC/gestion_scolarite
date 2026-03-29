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
        // On compte le nombre d'enregistrements dans chaque table
        $countClasses = Classe::count();
        $countTarifs = Tarif::count();
        $countFilieres = Filiere::count();

        // On récupère les 5 dernières classes ajoutées pour l'affichage rapide
        $recentClasses = Classe::with(['filiere', 'niveau'])->latest()->take(5)->get();

        return view('dashboard', compact('countClasses', 'countTarifs', 'countFilieres', 'recentClasses'));
    }
}
