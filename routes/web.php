<?php

use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\CategorieNiveauxController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\TarifController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('filieres', FiliereController::class);

Route::resource('classes', ClasseController::class);

Route::resource('tarifs', TarifController::class);
// Routes spécifiques pour le rattachement
Route::get('/rattacher-tarif', [TarifController::class, 'showRattacher'])->name('tarifs.rattacher.show');
Route::post('/rattacher-tarif', [TarifController::class, 'storeRattacher'])->name('tarifs.rattacher.store');

Route::resource('categories', CategorieNiveauxController::class);

Route::resource('niveaux', NiveauxController::class);

Route::resource('annees', AnneeAcademiqueController::class);
Route::patch('/annees/{annee}/publier', [AnneeAcademiqueController::class, 'publier'])->name('annees.publier');
Route::patch('/annees/{annee}/ouvrir-inscriptions', [AnneeAcademiqueController::class, 'ouvrirInscriptions'])->name('annees.ouvrir-inscriptions');
Route::patch('/annees/{annee}/fermer-inscriptions', [AnneeAcademiqueController::class, 'fermerInscriptions'])->name('annees.fermer-inscriptions');
Route::patch('/annees/{annee}/cloturer', [AnneeAcademiqueController::class, 'cloturer'])->name('annees.cloturer');