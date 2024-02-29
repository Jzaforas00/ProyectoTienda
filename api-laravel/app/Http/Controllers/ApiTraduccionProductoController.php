<?php

namespace App\Http\Controllers;

use App\Models\TraduccionProducto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTraduccionProductoRequest;

class ApiTraduccionProductoController extends Controller
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
        $traduccionproductos = TraduccionProducto::all();
        return response()->json([
            'status' => true,
            'TraduccionP' => $traduccionproductos
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
    public function store(StoreTraduccionProductoRequest $request)
    {
        try {
            $traduccionP = TraduccionProducto::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "TraduccionProducto creado correctamente",
                'TraduccionP' => $traduccionP
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear la TraduccionProducto",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TraduccionProducto $traduccionProducto)
    {
        return response()->json($traduccionProducto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TraduccionProducto $traduccionProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TraduccionProducto $traduccionProducto)
    {
        try {
            $traduccionProducto->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "TraduccionProducto actualizada correctamente",
                'TraduccionP' => $traduccionProducto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la traduccionProducto",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TraduccionProducto $traduccionProducto)
    {
        try {
            $traduccionProducto->delete();
    
            return response()->json([
                'status' => true,
                'message' => "TraduccionProducto eliminada correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar la TraduccionProducto",
            ], 500);
        }
    }

    /**
     * Remove all translations associated with a product by its ID.
     */
    public function eliminarTraduccionesPorProducto($id_producto)
    {
        try {
            TraduccionProducto::where('producto_id', $id_producto)->delete();

            return response()->json([
                'status' => true,
                'message' => "Todas las traducciones del producto fueron eliminadas correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar las traducciones del producto",
            ], 500);
        }
    }

    /**
     * Get all translations associated with a product by its ID.
     */
    public function obtenerTraduccionesPorProducto($id_producto)
    {
        try {
            // Selecciona todas las traducciones del producto por su ID
            $traducciones = TraduccionProducto::where('producto_id', $id_producto)->get();

            return response()->json([
                'status' => true,
                'message' => "Traducciones del producto obtenidas correctamente",
                'traducciones' => $traducciones,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al obtener las traducciones del producto",
            ], 500);
        }
    }
}
