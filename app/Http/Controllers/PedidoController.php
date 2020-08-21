<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Pedido::orderBy('fecha_pedido', 'desc')->paginate(5);
        
        return $p;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido1 = new Pedido;
        $pedido1->fecha_pedido = "20-08-20";
        $pedido1->estado = 0;
        $pedido1->cliente_id = $request->cliente_id;
        $pedido1->monto_total = $request->monto_total;
        $pedido1->save();

        for ($i=0; $i < count($request->productos); $i++) { 
            $pedido1->productos()->attach($request->productos[$i]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Pedido::find($id);
        if($p){
            $p->cliente;
            $p->productos;
            return $p;
        }
        return response()->json(["mensaje" => "El pedido no existe"], 404);
        
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
        //Pendiente...
        /*$pedido1 = Pedido::find($id);
        $pedido1->fecha_pedido = "20-08-20";
        $pedido1->estado = 0;
        $pedido1->cliente_id = $request->cliente_id;
        $pedido1->monto_total = $request->monto_total;
        $pedido1->save();

        for ($i=0; $i < count($request->productos); $i++) { 
            $pedido1->productos()->attach($request->productos[$i]);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //detach
    }
}
