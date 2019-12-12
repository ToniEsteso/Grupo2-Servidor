<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CarouselController extends BaseController
{
    
    function GetAll(){
        $imagenes =  Storage::files('public_images');
        var_dump($imagenes);
        // Si $imagenes no está vacio, retorna success. Si está vacio retornará error 404.
        if(empty($imagenes)){
             $respuesta =  config('error.404');
        }  else{
            $respuesta =  [config('error.200'), public_path('imagenes'), $imagenes];
        } 

        return $respuesta;
    }
    function Get($id){
        $respuesta = array(
            // "mensaje" => "Imagen del carousel " . $id,
            // "data" => Carousel::Where("id", $id)->get()
        );

        return $respuesta;
    }
}
