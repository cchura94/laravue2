<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
class ClienteController extends Controller
{
    public function listar()
    {
        $respuesta = Cliente::paginate(10);
        return response()->json($respuesta);        
    }

    public function guardar(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombres= $request->nombres;
        $cliente->apellidos =$request->apellidos;
        $cliente->empresa =$request->empresa;
        $cliente->correo =$request->correo;
        $cliente->telefono =$request->telefono;
        $cliente->ci_nit =$request->ci_nit;
        $cliente->save();
        
        return response()->jon(["mensaje" => "Cliente registrado"]);

    }

    public function mostrar($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    public function modificar($id, Request $request)
    {
        $cliente = Cliente::find($id);
        $cliente->nombres= $request->nombres;
        $cliente->apellidos =$request->apellidos;
        $cliente->empresa =$request->empresa;
        $cliente->correo =$request->correo;
        $cliente->telefono =$request->telefono;
        $cliente->ci_nit =$request->ci_nit;
        $cliente->save();
        return response()->jon(["mensaje" => "Cliente modificado"]);
    }

    public function eliminar($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
    }

    public function contactos()
    {
        return view("contacto");
    }
}
