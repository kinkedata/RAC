<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id');
            $table->integer('ciudad_id');
            $table->integer('tienda_id');
            $table->string('nombre', 255);
            $table->string('segundo_nombre', 255)->nullable();
            $table->string('a_paterno', 255);
            $table->string('a_materno', 255)->nullable();
            $table->string('telefono', 50);
            $table->string('celular', 50);
            $table->string('producto', 50);
            $table->string('email', 255);
            $table->integer('status_id')->nullable()->default('1');
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
        Schema::dropIfExists('contactos');
    }
}
