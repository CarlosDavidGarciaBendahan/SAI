<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->date('sol_fecha')->nullable(false);
            $table->enum('sol_tipo',['cambio','devolucion'])->nullable(false);
            $table->string('sol_concepto')->nullable(false);
            $table->enum('sol_aprobado',['S','N'])->nullable(false)->default('N');
            $table->integer('sol_fk_notaentrega')->unsigned()->nullable(false);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('solicitud');
    }
}
