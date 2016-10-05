<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'fecha', 'accion', 'modulo',  'id_ref', 'id_user', 'detalle'
    ];

	protected $primaryKey="id";

	public $timestamps = true;

	public function getuser()
	{
	    return $this->belongsTo('App\User', 'id_user');
	}
}
