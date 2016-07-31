<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienRaizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_raiz', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('valor_inicial');
            $table->bigInteger('avaluo_fiscal');
            $table->string('num_rol');
            $table->bigInteger('valor_total');
            $table->integer('id_centro');
            $table->integer('id_sector');
            $table->string('num_alta');
            $table->string('orden_compra');
            $table->date('fecha_incorporacion');
            $table->string('cuenta_contable');
            $table->string('tipo_inventario');
            $table->string('tipo_bien');
            $table->string('observacion');
            $table->string('mejora');
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
        Schema::dropIfExists('bien_raiz');
    }
}
