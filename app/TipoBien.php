<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoBien extends Model
{
    protected $table = 'tipo_bien';
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 
    ];

	protected $primaryKey="id";
	public $timestamps = true;

}
