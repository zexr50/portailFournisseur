<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne_ressource extends Model
{
    use HasFactory;



    public function fournisseur(): BelongTo
    {
        return $this->BelongTo(Fournisseur::class);
    }

    public function telephone(): BelongTo
    {
        return $this->BelongTo(Telephone::class);
    }
}
