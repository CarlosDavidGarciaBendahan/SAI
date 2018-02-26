<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegistropago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registropago', function (Blueprint $table) {
            $table->increments('id');
            $table->date('reg_fecha_pagado')->nullable(false);
            $table->float('reg_monto',10,2)->nullable(false);
            $table->enum('reg_moneda',['$','Bs'])->nullable(false);
            $table->string('reg_concepto',100)->nullable(false);
            $table->enum('reg_forma',['efectivo','deposito','transferencia','cheque'])->nullable(false);
            $table->float('reg_numero_referencia',10)->nullable(false);
            $table->integer('reg_fk_banco_origen')->unsigned();
            $table->integer('reg_fk_banco_destino')->unsigned();
            $table->integer('reg_fk_venta')->unsigned()->nullable(false);

            $table->timestamps();


            $table->unique('reg_numero_referencia','REGISTROPAGO_UNIQUE_reg_numero_referencia');
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
        Schema::dropIfExists('registropago');
    }
}
