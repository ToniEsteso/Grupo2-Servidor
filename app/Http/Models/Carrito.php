<?php

namespace App\Http\Models;

use Eloquent;

class Carrito extends Eloquent
{
    protected $table = 'carritos';
    protected $primaryKey = 'idCarrito';
    protected $fillable = array('idCarrito', 'idUsuario', 'fechaCompra', 'estado');
    public $timestamps = false;
}
