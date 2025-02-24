<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    //
    protected $fillable = [
        'nom_ville',
        'slug_ville',
        'region_id',
        'status'
    ];


    public function regions(){

        return $this->belongsTo('App\Regions');

    }

}
