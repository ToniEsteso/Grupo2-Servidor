<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Carousel;
use App\Http\Models\Mensaje;

class CarouselController extends BaseController
{
    function GetAll(){
        $directorio = '/imagenes';
        // $imagenes = scandir($directorio);
        $imagenes = "";
        // Si $imagenes no está vacio, retorna success. Si está vacio retornará error 404. DARLE UNA VUELTA
        if(empty($imagenes)){
            $respuesta = new Mensaje(404, $imagenes);
            var_dump($respuesta->respuesta["mensaje"]);
        } /* else{
        } */

        return $respuesta;
    }
    function Get($id){
        $respuesta = array(
            "mensaje" => "Imagen del carousel " . $id,
            "data" => Carousel::Where("id", $id)->get()
        );

        return $respuesta;
    }
}
