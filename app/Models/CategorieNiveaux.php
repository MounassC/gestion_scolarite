<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieNiveaux extends Model
{
    use HasFactory;

    protected $table = 'categorie_niveaux';
    protected $fillable = ['categorie_niveau'];

    public function niveaux()
    {
        return $this->hasMany(Niveau::class);
    }
}
