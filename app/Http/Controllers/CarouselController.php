<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Carousel;

class CarouselController extends BaseController
{
    function GetAll(){
        $respuesta = array(
            "mensaje" => "Todas las imagenes del carousel",
            "data" => Carousel::get()
        );

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
