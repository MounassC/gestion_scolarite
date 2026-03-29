<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifClasse extends Model
{
    use HasFactory;

    protected $table = 'tarif_classes';
    protected $fillable = ['tarif_id', 'classe_id', 'is_active'];

    // Optionnel : tu peux ajouter les relations pour faciliter les requêtes
    public function tarif() {
        return $this->belongsTo(Tarif::class);
    }

    public function classe() {
        return $this->belongsTo(Classe::class);
    }
}
