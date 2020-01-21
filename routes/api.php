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

Route::get('/categorias/{categoria}', 'CategoriasController@Get');

Route::get('/categorias/{categoria}/productos', 'CategoriasController@ProductosPorCategoria');

//PRODUCTOS
Route::get('/productos', 'ProductosController@GetAll');

Route::get('/productos/{producto}', 'ProductosController@Get');

//RECETAS
Route::get('/recetas', 'RecetasController@GetAll');

//CAROUSEL
// Route::get('/carousel', 'CarouselController@GetAll');

Route::get('/carousel', 'CarouselController@GetImagenesPromocion');

//USUARIOS

//REDES SOCIALES
Route::get('/redessociales', 'RedesSocialesController@GetAll');

Route::get('/redessociales/{id}', 'RedesSocialesController@Get');

// CARRITO
Route::post('/carrito', 'CarritoController@insertarCarrito');


//LOGIN
Route::group([
    'prefix' => 'auth',
], function (){
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});
