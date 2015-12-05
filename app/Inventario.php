<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'wm_inventario';
	protected $fillable = ['id_producto', 'cantidad'];
	protected $primaryKey="id";

	public $timestamps = false;
}
