<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom_intervenant')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->integer('fiche_intervention')->nullable();
            $table->timestamp('date_livraison')->nullable();
            $table->tinyInteger('sign_chef')->default('0');
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
        Schema::dropIfExists('livraisons');
    }
}
