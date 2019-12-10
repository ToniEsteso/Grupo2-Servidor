<?php

namespace App\Http\Models;

use Eloquent;

class Productos extends Eloquent
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'nombre', 'descripcion', 'imagen');
}
