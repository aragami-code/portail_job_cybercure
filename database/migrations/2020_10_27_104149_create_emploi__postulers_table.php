<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploiPostulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploi__postulers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_emploi_id');
            $table->longText('lettre');
            $table->integer('is_selected');
            $table->integer('is_interviewed');
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
        Schema::dropIfExists('emploi__postulers');
    }
}
