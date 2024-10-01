<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;

    protected $fillable = ['type_tel', 'no_tel', 'poste_tel', 'id_fournisseurs'];

    protected $table = 'telephone';

    public function fournisseur(): BelongTo
    {
        return $this->BelongTo(Fournisseur::class);
    }

    public function personne_ressource(): HasOne
    {
        return $this->hasOne(Personne_ressource::class);
    }
}
