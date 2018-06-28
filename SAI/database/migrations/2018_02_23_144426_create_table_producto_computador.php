<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductoComputador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_computador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_com_codigo')->nullable(false);
            $table->string('pro_com_descripcion')->nullable(true);
            $table->integer('pro_com_cantidad')->nullable(true);
            $table->float('pro_com_precio',9,2)->nullable(false);
            $table->enum('pro_com_moneda',['$','Bs'])->nullable(false);
            $table->integer('pro_com_catalogo')->default(0);
            $table->integer('pro_com_fk_sector')->unsigned();
            $table->integer('pro_com_fk_modelo')->unsigned();
            $table->integer('pro_com_fk_tipo_producto')->unsigned();
            $table->integer('cantidad_minima')->nullable(true);

            $table->timestamps();

            $table->unique('pro_com_codigo','PRODUCTO_COMPUTADOR_UNIQUE_pro_com_codigo');

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
        Schema::dropIfExists('producto_computador');
    }
}
