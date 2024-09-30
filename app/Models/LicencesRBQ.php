<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicencesRBQ extends Model
{
    use HasFactory;

    protected $table = 'licences_rbq';
    public $timestamps = false;

    public function fourniseur_licences_rbq_liaison(): HasMany
    {
        return $this->hasMany(Fourniseur_licences_rbq_liaison::class);
    }
}
