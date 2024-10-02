<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssurancesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('assurances', function (Blueprint $table) {

            $table->id();

            $table->date('date_ass')->nullable();
            $table->date('exp_ass')->nullable();
            $table->integer('rappel_ass')->nullable();
            $table->string('vehicule')->nullable();

            $table->date('date_taxe')->nullable();
            $table->date('exp_taxe')->nullable();
            $table->integer('rappel_taxe')->nullable();

            $table->date('der_vt')->nullable();
            $table->date('proch_vt')->nullable();
            $table->integer('rappel_vt')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assurances');
    }
}
