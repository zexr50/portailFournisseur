<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region_administrative extends Model
{
    use HasFactory;

    public function fournisseur(): HasOne
    {
        return $this->hasOne(Fournisseur::class);
    }
}
