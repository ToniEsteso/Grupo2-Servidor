<?php

namespace App\Http\Models;

use Eloquent;

class Productos extends Eloquent
{
    protected $table = 'carritos';
    protected $primaryKey = 'id';
    protected $fillable = array('idCarrito', 'idUsuario', 'fechaCompra');
}
