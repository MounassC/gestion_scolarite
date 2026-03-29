<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom_classe', 'code_classe', 'filiere_id', 'niveau_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function tarifs()
    {
        return $this->belongsToMany(Tarif::class, 'tarif_classes', 'classe_id', 'tarif_id')
            ->withPivot('is_active')
            ->withTimestamps();
    }

    public function tarifActif()
    {
        return $this->belongsToMany(Tarif::class, 'tarif_classes', 'classe_id', 'tarif_id') // Ajoute les clés ici aussi
            ->wherePivot('is_active', true)
            ->withPivot('is_active');
    }
}
