<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emploi_Postuler extends Model
{
    //
    protected $fillable = [ 'user_id','post_emploi_id','letter','is_selected','is_interviewed'];

}
