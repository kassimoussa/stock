<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels_livres', function (Blueprint $table) {
            $table->id();
            $table->integer('livraison_id')->nullable();
            $table->string('nom_materiel')->nullable();
            $table->string('marque_mat')->nullable();
            $table->string('description_mat')->nullable();
            $table->string('quantite')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiels_livres');
    }
}
