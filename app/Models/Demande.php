<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ['id_fournisseurs', 'etat_demande', 'raison_refus', 'commentaire'];

   protected $table = 'demandesFournisseurs';
}
