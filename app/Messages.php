<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //
    protected $fillable = [
        'id','Name','Email','Objet','Message','status'
    ];
}
