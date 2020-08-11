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

Route::get("/cliente", "ClienteController@listar")->name("cliente.listar");
Route::post("/cliente", "ClienteController@guardar")->name("cliente.guardar");
Route::get("/cliente/{id}", "ClienteController@mostrar")->name("cliente.mostrar");
Route::put("/cliente/{id}", "ClienteController@modificar")->name("cliente.modificar");
Route::delete("/cliente/{id}", "ClienteController@eliminar")->name("cliente.eliminar");

Route::apiresource("/producto", "ProductoController");
Route::apiresource("/categoria", "CategoriaController");

