<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BienActivo extends Model
{
    protected $table = 'bien_activo';
    protected $fillable = [
        'categoria', 'id_centro', 'id_sector', 'cuenta_contable',
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

	public function cuentacontable()
	{
	    return $this->belongsTo('App\CuentaContable', 'cuenta_contable');
	}
}
