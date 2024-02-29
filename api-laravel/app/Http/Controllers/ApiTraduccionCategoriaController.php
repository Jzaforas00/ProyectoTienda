<?php

namespace App\Http\Controllers;

use App\Models\TraduccionCategoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTraduccionCategoriaRequest;

class ApiTraduccionCategoriaController extends Controller
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
        $traduccionCategorias = TraduccionCategoria::all();
        return response()->json([
            'status' => true,
            'TraduccionC' => $traduccionCategorias
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
    public function store(StoreTraduccionCategoriaRequest $request)
    {
        try {
            $traduccionC = TraduccionCategoria::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "TraduccionCategoria creada correctamente",
                'TraduccionC' => $traduccionC
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear la TraduccionCategoria",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TraduccionCategoria $traduccionCategoria)
    {
        return response()->json($traduccionCategoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TraduccionCategoria $traduccionCategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TraduccionCategoria $traduccionCategoria)
    {
        try {
            $traduccionCategoria->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "TraduccionCategoria actualizada correctamente",
                'TraduccionC' => $traduccionCategoria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la traduccionCategoria",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TraduccionCategoria $traduccionCategoria)
    {
        try {
            $traduccionCategoria->delete();
    
            return response()->json([
                'status' => true,
                'message' => "TraduccionCategoria eliminada correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar la traduccionCategoria",
            ], 500);
        }
    }
}
