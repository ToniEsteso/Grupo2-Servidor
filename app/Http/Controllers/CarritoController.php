<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    function Get($idUsuario){
        $carrito = Carrito::Where("idUsuario", $idUsuario)->get();

        if(empty($carrito)){
            $respuesta =  config('codigosRespuesta.404');
        } else{
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "data" => $carrito];
        }

        return $respuesta;
    }

    function insertarCarrito($carrito){
        $credentials = request(['idUsuario', 'fechaCompra', "productosCarrito"]);
        $carrito = new Carrito();
        $carrito->id = $credentials["idUsuario"];
        $carrito->fechaCompra = $credentials["fechaCompra"];

    }
}
