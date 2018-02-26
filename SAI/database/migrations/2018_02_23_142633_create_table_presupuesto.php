<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto', function (Blueprint $table) {
            $table->increments('id');
            $table->date('pre_fecha_solicitado')->nullable(false);
            $table->date('pre_fecha_aprobado');
            $table->float('pre_subtotal',10,2)->nullable(false);
            $table->integer('pre_eliminado')->default(0);
            $table->integer('pre_fk_empresa')->unsigned()->nullable(false);
            $table->integer('pre_fk_cliente_natural')->unsigned();
            $table->integer('pre_fk_cliente_juridico')->unsigned();

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
        Schema::dropIfExists('presupuesto');
    }
}
