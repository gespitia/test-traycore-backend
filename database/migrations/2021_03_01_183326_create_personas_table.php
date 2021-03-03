<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->unsignedBigInteger('n_idententidad');
            $table->unsignedInteger('edad');
            $table->unsignedInteger('peso');
            $table->unsignedInteger('altura');
            $table->string('genero',10);
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('planeta_id');
            $table->foreign('planeta_id')->on('planetas')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('personas');
    }
}
