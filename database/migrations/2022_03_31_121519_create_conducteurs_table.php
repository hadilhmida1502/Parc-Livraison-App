<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConducteursTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_conducteur');
            $table->string('etat_conducteur')->nullable();
            $table->date('date_naissance_conducteur');
            $table->date('date_embauche_conducteur');
            $table->string('type_permis');
            $table->string('num_permis_conducteur');
            $table->string('ville_conducteur');
            $table->integer('code_postal_conducteur');
            $table->string('email_conducteur');
            $table->integer('tel_conducteur');
            $table->string('avatar_conducteur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conducteurs');
    }
}
