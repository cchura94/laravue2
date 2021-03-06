<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});



Route::group([
    'middleware' => 'auth:api', //  /api/cliente

], function ($router) {

        Route::get("/producto/{id}/calificar_estrellas", "ProductoController@calificar")->name("califica_prod");

        Route::get("/cliente", "ClienteController@listar")->name("cliente.listar");
        Route::post("/cliente", "ClienteController@guardar")->name("cliente.guardar");
        Route::get("/cliente/{id}", "ClienteController@mostrar")->name("cliente.mostrar");
        Route::put("/cliente/{id}", "ClienteController@modificar")->name("cliente.modificar");
        Route::delete("/cliente/{id}", "ClienteController@eliminar")->name("cliente.eliminar");

        
        Route::apiresource("/categoria", "CategoriaController");
        Route::apiresource("/pedido", "PedidoController");
        Route::apiresource("/usuario", "UsuarioController");
        Route::apiresource("/producto", "ProductoController");

        Route::apiresource("/pais", "PaisController");
        Route::apiresource("/ciudad", "CiudadController");
        Route::apiresource("/municipio", "MunicipioController");

});
