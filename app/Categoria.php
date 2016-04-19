<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
	protected $fillable = ['codigo', 'categoria',  'descripcion'];
	protected $primaryKey="id";

	public $timestamps = false;

}