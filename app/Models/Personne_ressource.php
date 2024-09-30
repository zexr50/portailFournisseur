<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne_ressource extends Model
{
    use HasFactory;

    protected $fillable = ['prenom', 'nom', 'fonction', 'email_contact', 'id_telephone', 'id_fournisseurs'];

    public function fournisseur(): BelongTo
    {
        return $this->BelongTo(Fournisseur::class);
    }

    public function telephone(): BelongTo
    {
        return $this->BelongTo(Telephone::class);
    }
}
