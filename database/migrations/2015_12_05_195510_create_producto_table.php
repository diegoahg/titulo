<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producto');
    }
}
