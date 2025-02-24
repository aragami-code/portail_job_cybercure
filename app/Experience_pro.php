<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience_pro extends Model
{
    //
    protected $fillable = [
        'id','user_id','titre_job','entreprise','date_debut','date_fin','actif','mission',
    ];
}
