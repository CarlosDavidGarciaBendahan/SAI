<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticuloSolicitudEntregado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_solicitudentregado', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('art_sol_fk_solicitud')->unsigned()->nullable(false);
            $table->integer('art_sol_fk_codigoarticulo')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['art_sol_fk_codigoarticulo','art_sol_fk_solicitud'],'ARTICULO_SOLICITUDENTREGADO_UNIQUE_articulo_solicitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('articulo_solicitudEntregado');
    }
}
