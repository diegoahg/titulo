<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sector';
    protected $fillable = [
        'nombre', 'id_centro_costo'
    ];

	protected $primaryKey="id";

	public $timestamps = false;

	public function centrocosto()
	{
	    return $this->belongsTo('App\CentroCosto', 'id_centro_costo');
	}
}


