<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    protected $table = 'centro_costo';
    protected $fillable = [
        'nombre', 
    ];

	protected $primaryKey="id";

	public $timestamps = false;
}


