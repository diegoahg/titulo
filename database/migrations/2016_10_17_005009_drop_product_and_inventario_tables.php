<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProductAndInventarioTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('producto');
        Schema::drop('inventario');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_usuario');
            $table->string('fecha');
            $table->string('centro');
            $table->string('oficina');
            $table->string('categoria');
            $table->string('numero');
            $table->string('descripcion');
            $table->string('valor');
            $table->string('unidad');
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->string('largo');
            $table->string('ancho');
            $table->string('alto');
            $table->string('orden');
            $table->string('cuenta_contable');
            $table->string('alta');
            $table->string('vida_util');
            $table->string('tipo_inventario');
            $table->string('tipo_bien');
            $table->string('enmienda');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('codigo');
            $table->string('categoria');
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->string('largo');
            $table->string('alto');
            $table->string('ancho');
            $table->string('peso');
            $table->string('imagen');
            $table->string('stock');
            $table->string('descripcion');
            $table->integer('precio');
        });

    }
}
