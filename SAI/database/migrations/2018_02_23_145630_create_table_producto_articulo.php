<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductoArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_articulo', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('pro_art_codigo')->nullable(false);
            $table->string('pro_art_descripcion')->nullable(true);
            $table->integer('pro_art_cantidad')->nullable(true);
            $table->float('pro_art_precio',9,2)->nullable(false);
            $table->enum('pro_art_moneda',['$','Bs'])->nullable(false);
            $table->integer('pro_art_catalogo')->default(0);
            $table->float('pro_art_capacidad',4,2)->nullable(true);
            $table->integer('pro_art_fk_unidadmedida')->unsigned()->nullable(true);
            $table->integer('pro_art_fk_sector')->unsigned();
            $table->integer('pro_art_fk_modelo')->unsigned();
            $table->integer('pro_art_fk_tipo_producto')->unsigned();
            $table->integer('cantidad_minima')->nullable(true);

            $table->timestamps();

            $table->unique('pro_art_codigo','PRODUCTO_ARTICULO_UNIQUE_pro_com_codigo');
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
        Schema::dropIfExists('producto_articulo');
    }
}
