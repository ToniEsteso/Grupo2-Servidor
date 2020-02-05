<?php

namespace App\Http\Controllers;

use App\Http\Models\Categorias;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends BaseController
{
    public function GetAll()
    {
        $categorias = Categorias::get();

        if (empty($categorias)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_categorias')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $categorias];
        }

        return $respuesta;
    }

    public function Get($categoria)
    {
        $cat = Categorias::Where("nombre", $categoria)->get();

        if (empty($cat)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_categorias')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $cat];
        }

        return $respuesta;
    }
    public function ProductosPorCategoria($categoria)
    {
        $productos = DB::table('productos')
            ->join('productos_categorias', 'productos.id', '=', 'productos_categorias.idProducto')
            ->join('categorias', 'categorias.id', '=', 'productos_categorias.idCategoria')
            ->where('categorias.nombre', $categoria)
            ->select('productos.*')->get();

        if (empty($productos)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaServerImagenes" => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $productos];
        }

        return $respuesta;
    }

    public function anyadirCategoria()
    {
        $credentials = request(['nombre', 'icono', 'imagen']);
        foreach ($credentials as $key => $value) {
            $key = strip_tags($key);
        }

        //insertar el usuario
        $categoria = new Categorias();
        $categoria->nombre = $credentials["nombre"];
        $categoria->precio = $credentials["icono"];

        $nombreImagen = $this->subirImagen($credentials["imagen"]);
        $categoria->imagen = $nombreImagen;

        if ($nombreImagen != null) {
            $usuario->save();
            return response()->json(['usuario' => $usuario]);
        } else {
            return response()->json(['mensaje' => "Vas a engañar a otro"]);
        }
    }

    public function subirImagen($nick)
    {
        $dir_subida = public_path() . str_replace("\\", "/", explode("public", Storage::disk('public_images_categorias')->getDriver()->getAdapter()->getPathPrefix())[1]);
        // $dir_subida = '/var/www/html/public/'.str_replace("\\", "/", explode("public",Storage::disk('public_images_categorias')->getDriver()->getAdapter()->getPathPrefix())[1]);

        $tipos = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/PNG', 'image/JPEG', 'image/JPG');

        if (in_array($_FILES['imagen']['type'], $tipos)) {
            $fichero_subido = $dir_subida . $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                return $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
    public function ProductosCategoria(){
        $datos = DB::table('categorias')
        ->join('productos_categorias', 'categorias.id', '=', 'productos_categorias.idCategoria')
        ->select(['categorias.nombre', DB::raw('COUNT(*) as numProductos')])
            ->groupBy('categorias.nombre')
            ->get();

            $respuesta = [
                "mensaje" => config('codigosRespuesta.200'),
                "data" => $datos];
                return $respuesta;
    }
}
