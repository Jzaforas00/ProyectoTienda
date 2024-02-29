<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsuarioRequest;

class ApiUsuarioController extends Controller
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
        $usuarios = Usuario::all();
        return response()->json([
            'status' => true,
            'usuarios' => $usuarios
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
    public function store(StoreUsuarioRequest $request)
    {
        try {
            $usuario = Usuario::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Usuario creado correctamente",
                'usuario' => $usuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el usuario",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return response()->json($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        try {
            $usuario->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Usuario actualizado correctamente",
                'usuario' => $usuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el usuario",
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();
    
            return response()->json([
                'status' => true,
                'message' => "Usuario eliminado correctamente",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar el usuario",
            ], 500);
        }
    }

    public function verificarCredenciales(Request $request)
    {
        $usuario = $request->input('usuario');
        $contrasena = $request->input('contrasena');

        // Buscar el usuario por nombre y contraseña
        $usuarioEncontrado = Usuario::where('nombre', $usuario)
                                    ->where('contrasena', $contrasena)
                                    ->first();

        if ($usuarioEncontrado) {
            // Usuario encontrado, devolver respuesta positiva
            return response()->json([
                'status' => true,
                'message' => 'Inicio de sesión exitoso',
                'usuario' => $usuarioEncontrado
            ]);
        } else {
            // Usuario no encontrado, devolver respuesta negativa
            return response()->json([
                'status' => false,
                'message' => 'Usuario o contraseña incorrectos'
            ]);
        }
    }

    /**
     * Buscar un usuario por su nombre de usuario y devolver su ID.
     */
    public function buscarPorNombre($nombre)
    {
        $usuario = Usuario::where('nombre', $nombre)->first();

        if ($usuario) {
            return response()->json([
                'status' => true,
                'usuario' => $usuario
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }
}
