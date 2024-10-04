<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne_ressource extends Model
{
    use HasFactory;

    protected $fillable = ['prenom_contact', 'nom_contact', 'fonction', 'email_contact', 'id_telephone', 'id_fournisseurs'];

    protected $table = 'personne_ressource';

    public function fournisseur(): BelongTo
    {
        return $this->BelongTo(Fournisseur::class);
    }

    public function telephone(): BelongTo
    {
        return $this->BelongTo(Telephone::class);
    }
}
