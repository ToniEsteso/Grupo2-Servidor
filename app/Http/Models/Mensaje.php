<?php

namespace App\Http\Models;

class Mensaje
{
    public $respuesta;

    function __construct($codigo, $data, $mensajePersonalizado = null){
        $mensajes = array("200" => "Todo correcto",
                    "404" => "No encontrado");

        $this->respuesta = array(
            "mensaje" => array( 
                "codigo"=> "$codigo :" . $mensajes[$codigo],
                "mensajePersonalizado" => $mensajePersonalizado
            ), 
            "data" => $data);
    }
}
