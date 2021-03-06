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
            $table->date('pre_fecha_solicitud')->nullable(false);
            $table->date('pre_fecha_aprobado')->nullable(true);
            $table->float('pre_subtotal',10,2)->nullable(false);
            $table->integer('pre_eliminado')->default(0);
            $table->integer('pre_fk_empresa')->unsigned()->nullable(false);
            $table->integer('pre_fk_cliente_natural')->unsigned()->nullable(true);
            $table->integer('pre_fk_cliente_juridico')->unsigned()->nullable(true);
            $table->float('precio_unitario',9,2)->nullable(false);

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
