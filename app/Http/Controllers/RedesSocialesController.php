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
        $redesSociales = RedesSociales::get();

        if(empty($redesSociales)){
            $respuesta = config('codigosRespuesta.404');
        } else{
            $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => $redesSociales);
        }

        return $respuesta;
    }
    function Get($redSocial){
        $rs = RedesSociales::Where("nombre", $redSocial)->get();

        if(empty($rs)){
            $respuesta = config('codigosRespuesta.404');
        } else{
            $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => $rs);
        }

        return $respuesta;
    }
}
