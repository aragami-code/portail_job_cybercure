<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post__emplois', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre_post_emploi');
            $table->string('slug_post_emploi');
            $table->string('contrat_post_emploi');
            $table->string('sectas_post_emploi');
            $table->string('typemp_post_emploi');
            $table->longText('description_post_emploi');
            $table->string('mode_de_paie_post_emploi');
            $table->integer('salaire_min_post_emploi');
            $table->integer('salaire_max_post_emploi');
            $table->integer('id_formation_post_emploi');
            $table->string('ex_prof_post_emploi');
            $table->string('sex_post_emploi');
            $table->string('nombre_place_post_emploi');
            $table->longText('tache_post_emploi');
            $table->integer('id_etat_post_emploi');
            $table->integer('id_region_post_emploi');
            $table->integer('id_ville_post_emploi');
            $table->integer('adresse_post_emploi');
            $table->date('DL');
            $table->unsignedBigInteger('id_admin');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post__emplois');
    }
}
