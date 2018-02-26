<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClienteJuridico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_juridico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cli_jur_nombre',50)->nullable(false);
            $table->string('cli_jur_direccion',200)->nullable(false);
            $table->enum('cli_jur_identificador',['J','G','C'])->nullable(false);
            $table->float('cli_jur_rif',10)->nullable(false);
            $table->integer('cli_jur_fk_parroquia')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['cli_jur_identificador','cli_jur_rif'],'CLIENTE_JURIDICO_UNIQUE_cli_jur_identificador_cli_jur_rif');
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
        Schema::dropIfExists('cliente_juridico');
    }
}
