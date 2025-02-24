<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobFav extends Model
{
    //
    protected $fillable = [
        'id','id_job','id_user',
    ];
}
