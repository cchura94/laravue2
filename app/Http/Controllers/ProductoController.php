<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //return $now = \Carbon\Carbon::now();
        $productos = Producto::All();
        return response()->json($productos) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar los datos
        $reglas = [
            "nombre" => "required|min:2|max:255",
            "precio" => "required"
        ];
        $validator = \Validator::make($request->all(), $reglas);
        if($validator->fails()){
            return response()->json([
                "creado" => false,
                "errores" => $validator->errors()->all()
            ]);
        }

        //$request->validate($reglas);
        //Subir Imagen
        $nombre_imagen = "";
        //Guardar en la base datos
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->detalle = $request->detalle;
        $producto->imagen = $nombre_imagen;
        $producto->save();
        
        return response()->json(["mensaje" => "El producto se ha registrado correctamente"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //select * from productos where id = $id 
        $producto = Producto::find($id);
        if($producto){
            return response()->json($producto, 200);
        }
        return response()->json(["status" => 404, "Mensaje" => "Producto no encontrado"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validamos (del lado del servidor)
        $reglas = [
            "nombre" => "required|min:2|max:255",
            "precio" => "required"
        ];
        $validator = \Validator::make($request->all(), $reglas);
        if($validator->fails()){
            return response()->json([
                "creado" => false,
                "errores" => $validator->errors()->all()
            ]);
        }

        //preguntamos si cambio la imagen

        //modificamos
        $producto = Producto::find($id);
        if($producto){
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->detalle = $request->detalle;
            $producto->imagen = $nombre_imagen;
            $producto->save();

            return response()->json(["mensaje" => "El producto se ha modificado correctamente"], 200);

        }

        return response()->json(["status" => 404, "Mensaje" => "Producto no encontrado"]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if($producto){
            $producto->delete();
            return response()->json(["mensaje" => "El producto se ha eliminado"], 200);

        }
        return response()->json(["status" => 404, "Mensaje" => "Producto no encontrado"]);
   
    }

    public function calificar($id)
    {
        $producto = Producto::find($id);
        $producto->estrella = $producto->estrella +1;
        $producto->save(); 
        return response()->json(["status" => 404, "Mensaje" => "Producto calicado"]);
   
    }
}
