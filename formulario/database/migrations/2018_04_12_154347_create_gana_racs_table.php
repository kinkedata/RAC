<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanaRacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gana_racs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contrato', 50);
            $table->string('nombre', 255);
            $table->string('celular', 50);
            $table->string('email', 255);
            $table->string('codigo_gana_rac', 50);
            $table->string('estatus', 10);
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
        Schema::dropIfExists('gana_racs');
    }
}
