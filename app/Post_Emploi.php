<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Emploi extends Model
{
    //
    protected $fillable = [
        'titre_post_emploi',
        'slug_post_emploi',
        'contrat_post_emploi',
        'sectas_post_emploi',
        'typemp_post_emploi',
        'description_post_emploi',
        'salaire_min_post_emploi',
        'salaire_max_post_emploi',
        'id_formation_post_emploi',
        'ex_prof_post_emploi',
        'sex_post_emploi',
        'nombre_place_post_emploi',
        'tache_post_emploi',
        'id_region_post_emploi',
        'id_ville_post_emploi',
        'profil_post_emploi',
        'id_admin',
        'DL',
    ];

}
