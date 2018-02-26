<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodigoarticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigoarticulo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_art_codigo')->nullable(false);
            $table->enum('cod_art_estado',['B','M'])->nullable(false)->default('B');
            $table->integer('cod_art_fk_producto_articulo')->unsigned()->nullable(false);
            $table->integer('cod_art_fk_lote')->unsigned()->nullable(false);
            $table->integer('cod_art_fk_pc')->unsigned();
            $table->timestamps();

            $table->unique('cod_art_codigo','CODIGOARTICULO_UNIQUE_cod_art_codigo');
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
        Schema::dropIfExists('codigoarticulo');
    }
}
