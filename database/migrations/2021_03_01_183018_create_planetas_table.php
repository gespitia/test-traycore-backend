<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('periodo_rotacion');
            $table->unsignedBigInteger('diametro');
            $table->string('clima',50);
            $table->string('terreno');
            $table->integer('masa');
            $table->integer('radio_orbital');
            $table->unsignedInteger('contador')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('planetas');
    }
}
