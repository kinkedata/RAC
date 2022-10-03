<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugerencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id');
            $table->integer('ciudad_id');
            $table->integer('tienda_id');
            $table->string('nombre', 255);
            $table->string('celular', 50)->nullable();
            $table->string('email', 255);
            $table->string('solicitud', 50);
            $table->text('comentarios');
            $table->integer('estatus_id');
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
        Schema::dropIfExists('sugerencias');
    }
}
