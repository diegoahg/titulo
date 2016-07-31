<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienLicenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_licencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('id_centro');
            $table->string('id_sector');
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
            $table->date('fecha_incorporacion');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bien_licencia');
    }
}
