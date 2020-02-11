<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CATEGORIAS
Route::get('/categorias', 'CategoriasController@GetAll');

Route::get('/categorias/productosCategoria', 'CategoriasController@ProductosCategoria');

Route::post('/categorias/nueva', 'CategoriasController@anyadirCategoria');

Route::get('/categorias/{categoria}', 'CategoriasController@Get');

Route::get('/categorias/{categoria}/productos', 'CategoriasController@ProductosPorCategoria');

Route::delete('/categorias/{categoria}', 'CategoriasController@BorrarCategoria');

//PRODUCTOS
Route::get('/productos', 'ProductosController@GetAll');

Route::get('/productos/numeroProductos', 'ProductosController@NumeroProductos');

Route::get('/productos/productosMasComprados', 'ProductosController@productosMasComprados');

Route::post('/productos/nuevo', 'ProductosController@anyadirProducto');

Route::get('/productos/{producto}', 'ProductosController@Get');

Route::get('/busqueda={producto}', 'ProductosController@GetBarra');

Route::delete('/productos/{idProducto}', 'ProductosController@BorrarProducto');

//RECETAS
Route::get('/recetas', 'RecetasController@GetAll');

Route::get('/recetas/numeroRecetas', 'RecetasController@NumeroRecetas');

Route::post('/recetas/nueva', 'RecetasController@anyadirReceta');

//CAROUSEL
// Route::get('/carousel', 'CarouselController@GetAll');

Route::get('/carousel', 'CarouselController@GetImagenesPromocion');

//USUARIOS

//REDES SOCIALES
Route::get('/redessociales', 'RedesSocialesController@GetAll');

Route::post('/redessociales', 'RedesSocialesController@CrearRedSocial');

Route::get('/redessociales/{id}', 'RedesSocialesController@Get');
Route::delete('/redessociales/{id}', 'RedesSocialesController@BorrarRedSocial');
Route::put('/redessociales/{id}', 'RedesSocialesController@ModificarRedSocial');

// CARRITO
Route::get('/carrito/numeroCompras', 'CarritoController@NumeroCompras');
Route::get('/carrito/resumenIngresos', 'CarritoController@ResumenIngresos');
Route::get('/carrito/{idUsuario}', 'CarritoController@Get');
Route::get('/historialCarritos/{idUsuario}', 'CarritoController@HistorialCarritos');
Route::post('/insertarCarritoTemporal', 'CarritoController@InsertarCarrito');
Route::post('/comprarCarrito', 'CarritoController@ComprarCarrito');

//LOGIN

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('me', 'AuthController@me');
    Route::get('numeroUsuarios', 'AuthController@getNumeroUsuarios');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register');
    Route::get('usuarios', 'AuthController@getAll');
    Route::delete('{idUsuario}', 'AuthController@BorrarUsuario');
});
