<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticuloSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('art_sol_fk_solicitud')->unsigned()->nullable(false);
            $table->integer('art_sol_fk_codigoarticulo')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['art_sol_fk_codigoarticulo','art_sol_fk_solicitud'],'PC_SOLICITUD_UNIQUE_articulo_solicitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_solicitud');
    }
}
