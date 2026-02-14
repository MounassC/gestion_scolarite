<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $table = 'niveaux';
    protected $fillable = ['nom_niveaux', 'categorie_niveau_id'];

    public function categorie_niveau()
    {
        return $this->belongsTo(CategorieNiveaux::class, 'categorie_niveau_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
