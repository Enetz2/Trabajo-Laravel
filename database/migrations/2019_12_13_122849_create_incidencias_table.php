<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_profesor');
            $table->string('equipo');
            $table->string('clase');
            $table->string('descripcion');
            $table->string('otro')->nullable();
            $table->string('comentario')->nullable();
            $table->string('estado');
            $table->foreign('id_profesor')->references('id')->on('profesors');
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
        Schema::dropIfExists('incidencias');
    }
}
