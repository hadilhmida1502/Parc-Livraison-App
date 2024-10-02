<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('marque');
            $table->string('type_vehicle');
            $table->integer('poids');
            $table->string('carburant');
            $table->date('mise_en_circulation');
            $table->integer('kilometrage');
            $table->string('etat_vehicle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
