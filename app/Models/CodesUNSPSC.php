<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodesUNSPSC extends Model
{
    use HasFactory;

    protected $table = 'code_unspsc';
    public $timestamps = false;

    public function fourniseur_code_unspsc_liaison(): HasMany
    {
        return $this->hasMany(Fourniseur_code_unspsc_liaison::class);
    }
}
