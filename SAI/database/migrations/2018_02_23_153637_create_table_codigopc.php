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
            $table->enum('cod_pc_estado',['B','M'])->default('B');
            $table->integer('cod_pc_fk_producto_computador')->unsigned()->nullable(false);
            $table->integer('cod_pc_fk_lote')->unsigned()->nullable(false);
            $table->float('cod_pc_costo',9,2)->nullable(false);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('codigopc');
    }
}
