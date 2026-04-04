<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annee_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Ex: 2025-2026

            // Les dates
            $table->date('dateOuverture');
            $table->date('dateFermeture');
            $table->date('dateDebutInscription');
            $table->date('dateFinInscription');

            // Le Statut avec une valeur par défaut "brouillon"
            // On utilise 'enum' pour limiter les choix possibles dans la base
            $table->enum('statut', [
                'brouillon',
                'publie',
                'ouvertureInscription',
                'fermetureInscription',
                'cloture'
            ])->default('brouillon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annee_academiques');
    }
};
