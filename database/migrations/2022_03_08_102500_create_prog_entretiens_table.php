<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgEntretiensTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('prog_entretiens', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation');
            $table->string('type_entretien');
            $table->integer('Prepete_number');
            $table->integer('Prappel_number');
            $table->integer('km_ent');
            $table->string('status_prog')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prog_entretiens');
    }
}
