<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorUsuario extends Model
{
    protected $table = 'sector_usuario';
    protected $fillable = [
        'id_usuario', 'id_centro', 'id_sector'
    ];

	protected $primaryKey="id";

	public $timestamps = true;

	public function centrocosto()
	{
	    return $this->belongsTo('App\CentroCosto', 'id_centro');
	}

	public function sector()
	{
	    return $this->belongsTo('App\Sector', 'id_sector');
	}
	
}
