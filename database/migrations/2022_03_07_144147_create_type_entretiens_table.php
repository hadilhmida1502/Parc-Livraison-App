<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeEntretiensTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('type_entretiens', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('Trepete_number');
            $table->integer('Trappel_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_entretiens');
    }
}
