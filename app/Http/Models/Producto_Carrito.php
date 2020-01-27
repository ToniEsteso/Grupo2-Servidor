<?php

namespace App\Http\Models;

use Eloquent;

class Producto_Carrito extends Eloquent
{
    protected $table = 'productos_carrito';
    protected $fillable = array('idProducto', 'idCarrito', 'cantidad');
    public $timestamps = false;
}
