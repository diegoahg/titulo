<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BienRegistro extends Model
{
    protected $table = 'bien_registro';
    protected $fillable = [
        'categoria', 'id_centro', 'id_sector', 
    ];

	protected $primaryKey="id";

	public $timestamps = true;

	public function category()
	{
	    return $this->belongsTo('App\Categoria', 'categoria');
	}

	public function centrocosto()
	{
	    return $this->belongsTo('App\CentroCosto', 'id_centro');
	}

	public function sector()
	{
	    return $this->belongsTo('App\Sector', 'id_sector');
	}
}
