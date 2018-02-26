<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClienteNatural extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_natural', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cli_nat_direccion',200)->nullable(false);
            $table->string('cli_nat_nombre',20)->nullable(false);
            $table->string('cli_nat_nombre2',20);
            $table->string('cli_nat_apellido',20)->nullable(false);
            $table->string('cli_nat_apellido2',20);
            $table->enum('cli_nat_identificador',['V','E','P'])->nullable(false);
            $table->float('cli_nat_cedula',9)->nullable(false);
            $table->integer('cli_nat_fk_parroquia')->unsigned()->nullable(false);


            $table->timestamps();

            $table->unique(['cli_nat_identificador','cli_nat_cedula'],'CLIENTE_NATURAL_UNIQUE_cli_nat_identificador_cli_nat_cedula');
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
        Schema::dropIfExists('cliente_natural');
    }
}
