<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competences extends Model
{
    //
    protected $fillable = [
        'id','user_id','competences_user','niveau','pourcentage',
    ];
}
