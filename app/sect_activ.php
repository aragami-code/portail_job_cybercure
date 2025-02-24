<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sect_activ extends Model
{
    //
    protected $fillable = [
        'nom_secteur', 'status',
    ];
}
