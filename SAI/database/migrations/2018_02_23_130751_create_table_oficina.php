<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOficina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficina', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('ofi_tipo',['local','almacen'])->nullable(false);    
            $table->string('ofi_direccion',250)->nullable(false);
            $table->integer('ofi_fk_parroquia')->unsigned()->nullable(false);
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
        Schema::dropIfExists('oficina');
    }
}
