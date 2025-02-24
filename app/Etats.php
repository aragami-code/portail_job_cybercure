<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etats extends Model
{
    //
            protected $fillable = [
                'nom_etat','slug_etat','code_etat','code_etat_tel'
            ];

            public function regions()
            {
                return $this->hasMany('App\Regions');

            }




}
