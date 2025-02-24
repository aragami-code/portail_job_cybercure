<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiveauEtude extends Model
{
    //
    protected $fillable = [
        'user_id', 'titre_niveau', 'option', 'institution', 'annee','description'
    ];
}
