<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('réf_cmd');
            $table->string('nature');
            $table->integer('poids_cmnd');
            $table->string('destinataire');
            $table->integer('tél_dest');
            $table->string('mail_dest');
            $table->string('ville_cmnd');
            $table->string('adr_cmnd');
            $table->string('status_cmd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
