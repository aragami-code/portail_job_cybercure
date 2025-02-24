<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evenements extends Model
{
    //
    protected $fillable = [
        'name_evenement',
        'sommaire_evenement',
        'image_evenement',
        'date_evenement',
    ];

}
