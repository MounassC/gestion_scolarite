<?php

use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\CategorieNiveauxController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\TarifsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('filieres', FiliereController::class);

Route::resource('classes', ClasseController::class);

Route::resource('tarifs', TarifsController::class);

Route::resource('categories', CategorieNiveauxController::class);

Route::resource('niveaux', NiveauxController::class);

Route::resource('annees', AnneeAcademiqueController::class);