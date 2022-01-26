<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCataloguepcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cataloguepcs', function (Blueprint $table) {
            $table->id();
            $table->string('direction')->nullable();
            $table->string('marque_mat')->nullable();
            $table->string('model_mat')->nullable();
            $table->string('processeur_mat')->nullable();
            $table->string('ram_mat')->nullable();
            $table->string('stockage_mat')->nullable();
            $table->string('os_mat')->nullable();
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
        Schema::dropIfExists('cataloguepcs');
    }
}
