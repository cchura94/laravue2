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
        $reglas = [
            "nombres" => "required|min:2|max:255",
            "apellidos" => "required|min:2|max:255",
            "correo" => "unique:clientes|min:2|max:255",
            "ci_nit" => "required|min:5|max:15",
            "empresa" => "required",
            "telefono" => "required|min:6|max:15"
        ];
        $validator = \Validator::make($request->all(), $reglas);
        if($validator->fails()){
            return response()->json([
                "creado" => false,
                "errores" => $validator->errors()->all()
            ]);
        }

        $cliente = new Cliente;
        $cliente->nombres= $request->nombres;
        $cliente->apellidos =$request->apellidos;
        $cliente->empresa =$request->empresa;
        $cliente->correo =$request->correo;
        $cliente->telefono =$request->telefono;
        $cliente->ci_nit =$request->ci_nit;
        $cliente->save();
        
        return response()->json(["mensaje" => "Cliente registrado"]);

    }

    public function mostrar($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    public function modificar($id, Request $request)
    {
        $reglas = [
            "nombres" => "required|min:2|max:255",
            "apellidos" => "required|min:2|max:255",
            "correo" => "min:2|max:255",
            "ci_nit" => "required|min:5|max:15",
            "empresa" => "required",
            "telefono" => "required|min:6|max:15"
        ];
        $validator = \Validator::make($request->all(), $reglas);
        if($validator->fails()){
            return response()->json([
                "creado" => false,
                "errores" => $validator->errors()->all()
            ]);
        }

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
