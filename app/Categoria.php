<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
	protected $fillable = ['codigo', 'nombre', 'precio', 'descuento', 'marca', 'descripcion', 'peso', 'largo', 'alto', 'peso', 'foto'];
	protected $primaryKey="id";

	public $timestamps = false;

}