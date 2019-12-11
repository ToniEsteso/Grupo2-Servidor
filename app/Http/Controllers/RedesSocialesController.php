<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\RedesSociales;

class RedesSocialesController extends BaseController
{
    function GetAll(){
        $respuesta = array(
            "mensaje" => "Todos las redes sociales",
            "data" => RedesSociales::get()
        );

        return $respuesta;
    }
    function Get($redSocial){
        $respuesta = array(
            "mensaje" => "Toda la informacion de" . $redSocial,
            "data" => RedesSociales::Where("nombre", $redSocial)->get()
        );

        return $respuesta;
    }
}
