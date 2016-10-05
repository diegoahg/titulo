<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{
    protected $table = 'cuenta_contable';
    protected $fillable = [
        'codigo', 'nombre', 'vida_util', 
    ];

	protected $primaryKey="id";
	public $timestamps = true;

}
