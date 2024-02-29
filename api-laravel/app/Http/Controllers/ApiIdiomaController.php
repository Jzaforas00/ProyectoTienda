<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIdiomaRequest;

class ApiIdiomaController extends Controller
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
        $idiomas = Idioma::all();
        return response()->json([
            'status' => true,
            'idiomas' => $idiomas
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
    public function store(StoreIdiomaRequest $request)
    {
        try {
            $idioma = Idioma::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Idioma creado correctamente",
                'idioma' => $idioma
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el idioma",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Idioma $idioma)
    {
        return response()->json($idioma);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idioma $idioma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idioma $idioma)
    {
        try {
            $idioma->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Idioma actualizado correctamente",
                'idioma' => $idioma
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el idioma",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idioma $idioma)
    {
        try {
            $idioma->delete();
    
            return response()->json([
                'status' => true,
                'message' => "Idioma eliminado correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar el idioma",
            ], 500);
        }
    }
}
