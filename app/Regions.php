<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    //
    protected $fillable = [
        'nom_region',
        'slug_region',
        'etat_id',
        'status'
    ];




    public function etats()
    {
        return $this->belongsTo('App\Etats');

    }

    public function villes(){
        return $this->hasMany('App\Villes');
    }
}
