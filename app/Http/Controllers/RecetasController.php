<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Recetas;

class RecetasController extends BaseController
{
    function GetAll(){
        $recetas = Recetas::get();

        if(empty($recetas)){
            $respuesta =  config('codigosRespuesta.404');
       }  else{
           $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaImagenesServer" => str_replace("\\", "/", explode("public",Storage::disk('public_images_recetas')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $recetas];
       }

       return $respuesta;
    }
}