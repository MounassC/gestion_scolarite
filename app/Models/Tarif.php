<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = ['inscription', 'mensualite'];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'tarif_classes', 'tarif_id', 'classe_id')
            ->withPivot('is_active')
            ->withTimestamps();
    }
}
