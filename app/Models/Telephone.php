<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;


    public function fournisseur(): BelongTo
    {
        return $this->BelongTo(Fournisseur::class);
    }

    public function personne_ressource(): HasOne
    {
        return $this->hasOne(Personne_ressource::class);
    }
}
