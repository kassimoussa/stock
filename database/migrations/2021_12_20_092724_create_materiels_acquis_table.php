<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsAcquisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels_acquis', function (Blueprint $table) {
            $table->id();
            $table->integer('fiche_acquisition')->nullable();
            $table->string('nom_mat')->nullable();
            $table->text('description_mat')->nullable();
            $table->string('marque_mat')->nullable();
            $table->string('processeur_mat')->nullable();
            $table->string('ram_mat')->nullable();
            $table->string('stockage_mat')->nullable();
            $table->string('os_mat')->nullable();
            $table->integer('quantite')->nullable();
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
        Schema::dropIfExists('materiels_acquis');
    }
}
