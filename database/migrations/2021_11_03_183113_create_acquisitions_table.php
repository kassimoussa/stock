<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcquisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_demandeur')->nullable();
            $table->string('dir_demandeur')->nullable();
            $table->string('service_demandeur')->nullable();
            $table->string('nom_mat')->nullable();
            $table->text('description_mat')->nullable();
            $table->string('marque_mat')->nullable();
            $table->string('model_mat')->nullable();
            $table->string('processeur_mat')->nullable();
            $table->string('ram_mat')->nullable();
            $table->string('stockage_mat')->nullable();
            $table->string('os_mat')->nullable();
            $table->timestamp('date_submit')->nullable();
            $table->string('status_dir')->nullable();
            $table->string('status_sih')->nullable();
            $table->string('status_dsi')->nullable();
            $table->string('date_dir')->nullable();
            $table->string('date_sih')->nullable();
            $table->string('date_dsi')->nullable();
            $table->string('recu')->default('non');
            $table->string('livre')->nullable();
            $table->string('commentaire_sih')->nullable();
            $table->string('commentaire_dsi')->nullable();
            $table->tinyInteger('status')->default('1'); 
            $table->string('submitbyID')->nullable();
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
        Schema::dropIfExists('acquisitions');
    }
}
