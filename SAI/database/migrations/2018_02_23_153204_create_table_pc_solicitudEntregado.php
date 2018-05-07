<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePcSolicitudEntregado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_solicitudentregado', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('pc_sol_fk_solicitud')->unsigned()->nullable(false);
            $table->integer('pc_sol_fk_codigopc')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['pc_sol_fk_codigopc','pc_sol_fk_solicitud'],'PC_SOLICITUDENTREGADO_UNIQUE_pc_solicitud');
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
        Schema::dropIfExists('pc_solicitudEntregado');
    }
}
