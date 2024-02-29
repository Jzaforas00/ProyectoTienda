<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Http\Requests\StorePedidoRequest;

class ApiPedidoController extends Controller
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json([
            'status' => true,
            'pedido' => $pedidos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        try {
            $pedido = Pedido::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Pedido creado correctamente",
                'pedido' => $pedido
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el pedido",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return response()->json($pedido);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        try {
            $pedido->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Pedido actualizado correctamente",
                'pedido' => $pedido
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el pedido",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        try {
            $pedido->delete();
    
            return response()->json([
                'status' => true,
                'message' => "Pedido eliminado correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar el pedido",
            ], 500);
        }
    }
}
