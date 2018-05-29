<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('id');
            $table->date('ven_fecha_compra')->nullable(false);
            $table->decimal('ven_monto_total',10,2)->nullable(false);
            $table->enum('ven_moneda',['$','Bs'])->nullable(false);
            $table->integer('ven_eliminada')->default(0);
            $table->integer('ven_porcentaje_descuento')->default(0);
            $table->integer('ven_fk_cliente_natural')->unsigned()->nullable(true);
            $table->integer('ven_fk_cliente_juridico')->unsigned()->nullable(true);
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
        Schema::dropIfExists('venta');
    }
}
