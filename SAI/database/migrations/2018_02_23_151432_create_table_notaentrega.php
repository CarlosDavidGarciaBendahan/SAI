<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotaentrega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaentrega', function (Blueprint $table) {
            $table->increments('id');
            $table->date('not_fecha')->nullable(false);
            $table->float('not_subtotal',10,2);
            $table->string('not_observaciones',200)->nullable(false);
            $table->integer('not_fk_empresa')->unsigned();
            $table->integer('not_fk_venta')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique('not_fk_venta','NOTAENTREGA_UNIQUE_not_fk_venta');
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
        Schema::dropIfExists('notaentrega');
    }
}
