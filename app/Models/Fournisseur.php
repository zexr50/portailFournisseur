<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['NEQ', 'nom_entreprise', 'email', 'mdp', 'no_rue', 'rue', 'no_bureau', 'ville',
     'province', 'no_region_admin', 'code_postal', 'site_internet', 'commentaire'];

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

    public function region()
    {
        return $this->belongsTo(Region_administrative::class, 'no_region_admin', 'no_region');
    }

    public function telephones()
    {
        return $this->hasMany(Telephone::class, 'id_fournisseurs',);
    }

    public function personne_ressources()
    {
        return $this->hasMany(Personne_ressource::class, 'id_fournisseurs');
    }




}
