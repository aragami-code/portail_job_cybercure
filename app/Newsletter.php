<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Newsletter extends Model
{
    //
    protected $fillable = [
        'email',
    ];

}
