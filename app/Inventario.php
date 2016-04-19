<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $fillable = [
        'categoria', 'centro', 'oficina', 
    ];

	protected $primaryKey="id";

	public $timestamps = true;

	public function category()
	{
	    return $this->belongsTo('App\Categoria', 'categoria');
	}

	public function centrocosto()
	{
	    return $this->belongsTo('App\CentroCosto', 'centro');
	}

	public function sector()
	{
	    return $this->belongsTo('App\Sector', 'oficina');
	}
}


