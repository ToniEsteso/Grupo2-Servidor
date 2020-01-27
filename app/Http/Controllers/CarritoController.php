<?php

namespace App\Http\Controllers;

use App\Http\Models\Carrito;
use App\Http\Models\Productos;
use App\Http\Models\Producto_Carrito;

class CarritoController extends Controller
{
    public function Get($idUsuario)
    {
        $carrito = Carrito::Where("idUsuario", $idUsuario)->get();

        if (empty($carrito)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "data" => $carrito];
        }

        return $respuesta;
    }
    public function HistorialCarritos($idUsuario)
    {
        $data = array();
        $carritos = Carrito::Where("idUsuario", $idUsuario)->get();

        foreach ($carritos as $carr) {
            $productosCarrito = Producto_Carrito::where('idCarrito', $carr->idCarrito)->get();
            $dataProductos = array();
            foreach ($productosCarrito as $prod) {
                $producto = Productos::where('id', $prod->idProducto)->get()[0];
                $dataProductos[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'descripcion' => $producto->descripcion,
                    'imagen' => $producto->imagen,
                    'unidades' => $prod->cantidad,
                ];
            }
            $data[] = [
                'idUsuario' => $idUsuario,
                'fechaCompra' => $carr->fechaCompra,
                'productos' => $dataProductos,
            ];
        }
        if (empty($carritos)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            // DEVOLVER TODOS LOS CARRITOS
            $respuesta = [
                "mensaje" => config('codigosRespuesta.200'),
                "data" => $data];
        }

        return $respuesta;
    }

    public function InsertarCarrito()
    {
        $credentials = request(['idUsuario', 'fechaCompra', "productos"]);
        $idUsuario = $credentials['idUsuario'];
        $fechaCompra = $credentials['fechaCompra'];
        $productos = $credentials['productos'];

        if ($credentials['idUsuario'] == 'invitado') {
            $respuesta = config('codigosRespuesta.404');
        } else {
            //TABLE CARRITOS
            $carrito = new Carrito();
            $carrito->idUsuario = $credentials["idUsuario"];
            $carrito->fechaCompra = $credentials["fechaCompra"];
            $carrito->save();

            //TABLA PRODUCTOS_CARRITO
            foreach ($productos as $key) {
                $productoCarrito = new Producto_Carrito();
                $productoCarrito->idProducto = $key["id"];
                $productoCarrito->idCarrito = $carrito->idCarrito;
                $productoCarrito->cantidad = $key["unidades"];
                $productoCarrito->save();
            }
        }
    }
}
