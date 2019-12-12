<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Productos;

class ProductosController extends BaseController
{
    function GetAll(){
        $respuesta = array(
            "mensaje" => "Todos los productos",
            "data" => Productos::get()
        );

        return $respuesta;
    }
    function Get($producto){
        $respuesta = array(
            "mensaje" => "Toda la informacion del producto " . $producto,
            "data" => Productos::Where("nombre", $producto)->get()
        );

        return $respuesta;
    }
}
