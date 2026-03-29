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
        Schema::create('tarif_classes', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la table tarifs
            $table->foreignId('tarif_id')->constrained('tarifs')->onDelete('cascade');
            // Clé étrangère vers la table classes
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');

            // Le champ pour savoir si c'est le tarif actuel
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_classes');
    }
};
