<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'wm_producto';
	protected $fillable = ['codigo', 'nombre', 'precio', 'descuento', 'marca', 'descripcion', 'peso', 'largo', 'alto', 'peso', 'foto'];
	protected $primaryKey="id";

	public $timestamps = false;

}