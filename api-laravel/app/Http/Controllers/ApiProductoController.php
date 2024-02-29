<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest;

class ApiProductoController extends Controller
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
        $productos = Producto::all();
        return response()->json([
            'status' => true,
            'producto' => $productos
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
    public function store(StoreProductoRequest $request)
    {
        try {
            $producto = Producto::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Producto creado correctamente",
                'producto' => $producto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el producto",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        try {
            $producto->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Producto actualizado correctamente",
                'producto' => $producto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el producto",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
    
            return response()->json([
                'status' => true,
                'message' => "Producto eliminado correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar el producto",
            ], 500);
        }
    }
}
