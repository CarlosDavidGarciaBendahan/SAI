<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodigopc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigopc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_pc_codigo')->nullable(false);
            $table->enum('cod_pc_estado',['B','M'])->nullable(false)->default('B');
            $table->integer('cod_pc_fk_producto_computador')->unsigned()->nullable(false);
            $table->integer('cod_pc_fk_lote')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique('cod_pc_codigo','CODIGOPC_UNIQUE_cod_pc_codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigopc');
    }
}
