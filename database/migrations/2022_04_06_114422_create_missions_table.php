<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('num_mission');
            $table->date('date_mission');
            $table->time('debut_mission');
            $table->time('fin_mission');
            $table->string('veh_mission');
            $table->string('cond_mission');
            $table->string('ref_cmd');
            $table->string('nature_cmd');
            $table->integer('poids_cmd');
            $table->string('destinataire_cmd');
            $table->integer('tel_dest');
            $table->string('email_dest');
            $table->string('ville_cmd');
            $table->string('adr_cmd');
            $table->tinyInteger('status')->default('0');
            $table->integer('kms')->nullable();
            $table->integer('idcmd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
