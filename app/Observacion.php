<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observacion';
    protected $fillable = [
        'observacion', 'id_bien', 'tipo_bien', 
    ];

	protected $primaryKey="id";

	public $timestamps = true;

}
