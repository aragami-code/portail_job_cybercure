<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNiveauEtudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveau_etudes', function (Blueprint $table) {
            $table->increments('id');
               $table->integer('user_id');
               $table->string('titre_niveau');
               $table->string('option');
               $table->integer('pays');
               $table->string('institution');
               $table->longText('description');
               $table->string('annee');
               $table->timestamp('created_at')->nullable()->useCurrent();

       });

       Schema::create('langue', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('user_id');
           $table->string('langue');
           $table->string('niveau');
           $table->timestamp('created_at')->nullable()->useCurrent();

   });

   Schema::create('apropos_cv', function (Blueprint $table) {
    $table->increments('id');
       $table->integer('user_id');
       $table->longText('apropos_de_moi');
       $table->timestamp('created_at')->nullable()->useCurrent();

});
Schema::create('competences', function (Blueprint $table) {
    $table->increments('id');
       $table->integer('user_id');
       $table->string('competences');
       $table->string('niveau');
       $table->integer('pourcentage');
       $table->timestamp('created_at')->nullable()->useCurrent();

});

Schema::create('Experience_pro', function (Blueprint $table) {
    $table->increments('id');
       $table->integer('user_id');
       $table->string('titre_job');
       $table->string('entreprise');
       $table->integer('pays');
       $table->integer('region');
       $table->integer('ville');
       $table->string('anne_debut');
       $table->string('mois_debut');
       $table->string('anne_fin');
       $table->string('mois_fin');
       $table->string('actif');
       $table->longText('mission');
       $table->timestamp('created_at')->nullable()->useCurrent();

});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveau_etudes');
        Schema::dropIfExists('langues');
        Schema::dropIfExists('apropos_cv');
        Schema::dropIfExists('competences');
        Schema::dropIfExists('Experience_pro');
    }
}
