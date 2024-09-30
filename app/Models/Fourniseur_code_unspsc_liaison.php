<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fourniseur_code_unspsc_liaison extends Model
{
    use HasFactory;




    public function CodesUNSPSCHas(): BelongsTo
    {
        return $this->belongsTo(CodesUNSPSC::class);
    }

    public function fournisseurHas(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
