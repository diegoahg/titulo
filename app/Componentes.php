<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componentes extends Model
{
    protected $table = 'componentes';
    protected $fillable = [
        'id_bien', 'codigo', 'descripcion',  'serie',  'marca',  'modelo',  'categoria', 'tipo', 
    ];

	protected $primaryKey="id";

	public $timestamps = true;

	public function bien()
	{
	    return $this->belongsTo('App\BienActivo', 'id_bien');
	}
}
