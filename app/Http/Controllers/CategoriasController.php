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
        $categoria->icono = $credentials["icono"];

        $nombreImagen = $this->subirImagen($credentials["nombre"]);
        $categoria->imagen = $nombreImagen;

        if ($nombreImagen != null) {
            $categoria->save();
            return response()->json(['categoria' => $categoria]);
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
            var_dump($fichero_subido);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                return $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
    public function ProductosCategoria()
    {
        $categoriasMasCompradas = DB::select(DB::raw('SELECT categorias.nombre, SUM(cantidad) as numProductos
        FROM carritos
        INNER JOIN productos_carrito
        INNER JOIN productos
        INNER JOIN productos_categorias
        INNER JOIN categorias

        ON carritos.idCarrito = productos_carrito.idCarrito
        AND productos_carrito.idProducto = productos.id
        AND productos.id = productos_categorias.idProducto
        AND productos_categorias.idCategoria = categorias.id

        WHERE carritos.estado = "comprado"

        GROUP BY idCategoria
        '));

        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $categoriasMasCompradas];
        return $respuesta;
    }
}
