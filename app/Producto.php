<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
	protected $fillable = ['codigo', 'nombre', 'categoria', 'modelo', 'marca', 'serie',  'descripcion', 'peso', 'largo', 'alto', 'peso', 'imagen', 'precio','stock'];
	protected $primaryKey="id";

	public $timestamps = false;

}