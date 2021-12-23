<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom_intervenant')->nullable();
            $table->string('nom_demandeur')->nullable();
            $table->string('dir_demandeur')->nullable();
            $table->string('service_demandeur')->nullable();
            $table->string('ref_patrimoine')->nullable();
            $table->string('materiel')->nullable();
            $table->string('model')->nullable();
            $table->timestamp('date_acquisition')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('diagnostique')->nullable();
            $table->string('suggestion')->nullable();
            $table->string('avis')->nullable();
            $table->timestamp('date_intervention')->nullable();
            $table->timestamp('date_sih')->nullable();
            $table->timestamp('date_din')->nullable();
            $table->timestamp('date_dir')->nullable(); 
            $table->string('status_sih')->nullable();
            $table->string('status_din')->nullable();
            $table->string('status_dir')->nullable();
            $table->string('status')->nullable();
            $table->integer('submitbyID')->nullable();
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
        Schema::dropIfExists('interventions');
    }
}
