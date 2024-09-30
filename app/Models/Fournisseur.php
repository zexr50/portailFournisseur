<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['NEQ', 'nom_entreprise', 'email', 'mdp', 'no_rue', 'rue', 'no_bureau', 'ville',
     'province', 'region_admins', 'code_postal', 'site_internet'];

    protected $table = 'fournisseurs';

    public function fourniseur_code_unspsc_liaison(): HasMany
    {
        return $this->hasMany(Fourniseur_code_unspsc_liaison::class);
    }

    public function fourniseur_licences_rbq_liaison(): HasMany
    {
        return $this->hasMany(Fourniseur_licences_rbq_liaison::class);
    }

    public function personne_ressource(): HasMany
    {
        return $this->hasMany(Personne_ressource::class);
    }

    public function region_administrative(): BelongTo
    {
        return $this->belongTo(Region_administrative::class);
    }

    public function telephone(): HasOne
    {
        return $this->hasOne(Telephone::class);
    }




}
