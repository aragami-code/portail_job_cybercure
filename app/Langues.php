<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langues extends Model
{
    //
    protected $fillable = [
        'id','user_id','langue','niveau'
    ];
}
