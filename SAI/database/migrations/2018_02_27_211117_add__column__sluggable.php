<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSluggable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banco', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('cliente_juridico', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('cliente_natural', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('codigoarticulo', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('codigopc', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('contacto_correo', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('contacto_telefono', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('detalle', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('empresa', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('estado', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('imagen', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('lote', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('marca', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('modelo', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('municipio', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('notaentrega', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('oficina', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('parroquia', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        /*Schema::table('permiso', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });*/
        Schema::table('personal', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('presupuesto', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('producto_articulo', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('producto_computador', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('registropago', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('rol', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('sector', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('solicitud', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('tipo_producto', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('unidadmedida', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('venta', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('X', function (Blueprint $table) {
            //
        });*/
    }
}
