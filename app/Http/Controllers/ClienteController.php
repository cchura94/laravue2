<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listar()
    {
        $respuesta = [
            "mensaje" => "listado de Clientes",
            "datos" => [[
                "nombre" => "juan", 
                "ci" => "2342323"], 
                ["nombre" =>"pedro", 
                "ci" => "83453434"
                ]]
            ];
        return response()->json($respuesta);        
    }

    public function guardar(Request $request)
    {
        return $request;
    }

    public function mostrar($id)
    {
        return $id;
    }

    public function modificar($id, Request $request)
    {
        return "Modificando: $id";
    }

    public function eliminar($id)
    {
        return "Eliminando : $id";
    }

    public function contactos()
    {
        return view("contacto");
    }
}
