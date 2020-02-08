<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\RedesSociales;
use Illuminate\Http\Request;

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

    function CrearRedSocial(Request $request) {
        $credentials = $request->json()->all();

        $redSocial = new RedesSociales();
        $redSocial->nombre = $credentials['nombre'];
        $redSocial->enlace = $credentials['enlace'];
        $redSocial->icono = $credentials['icono'];
        $redSocial->save();

        return $redSocial;
    }

    function BorrarRedSocial($redSocial){
        $red = RedesSociales::find($redSocial);
        $red->delete();
        $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => "Borrado exitosamente.");
        return $respuesta;
    }

    function ModificarRedSocial ($idRed, Request $request) {
        $credentials = $request->json()->all();
        $red = RedesSociales::find($idRed);
        $red->nombre = $credentials['nombre'];
        $red->enlace = $credentials['enlace'];
        $red->icono = $credentials['icono'];
        $red->save();

        $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => "Modificado exitosamente.");
        return $respuesta;
    }
}
