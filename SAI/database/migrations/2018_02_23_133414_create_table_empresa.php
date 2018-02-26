<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_nombre',20)->nullable(false);
            $table->string('emp_direccion',200)->nullable(false);
            $table->enum('emp_identificador',['J','G','C'])->nullable(false);
            $table->float('emp_rif',10)->nullable(false);
            $table->integer('emp_fk_parroquia')->nullable(false);
            $table->timestamps();


            $table->unique(['emp_identificador','emp_rif'],'EMPRESA_UNIQUE_emp_identificador_emp_rif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
