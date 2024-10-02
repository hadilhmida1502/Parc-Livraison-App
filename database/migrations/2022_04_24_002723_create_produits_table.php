<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produit_test');
            $table->integer('quantité_test');
            $table->integer('prix_test');
            $table->integer('total_test');
            $table->integer('Gtotal_test');

            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')->references('id')->on('commandes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
