<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
            $table->string('vida_util');
            $table->string('tipo_inventario');
            $table->string('tipo_bien');
            $table->string('enmienda');
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
        Schema::dropIfExists('inventario');
    }
}
