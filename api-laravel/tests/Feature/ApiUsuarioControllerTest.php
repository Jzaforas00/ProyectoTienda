<?php

namespace Tests\Feature\Usuario;

use App\Models\Usuario;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiUsuarioControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todos los usuarios.
     */
    public function testListarUsarios()
    {
        Usuario::factory()->count(3)->create();

        $response = $this->get('/api/usuarios');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'usuarios'
                 ]);
    }
    
    /** 
     * Crear un nuevo usuario.
     */
    public function testCrearUsuarios()
    {
        $userData = [
            'nombre' => 'Nombre de ejemplo',
            'contrasena' => 'contrasena123',
            'direccion' => 'Dirección de ejemplo',
            'telefono' => '123456789',
            'email' => 'usuario@example.com',
            'rol_id' => 1,
        ];

        $response = $this->postJson('/api/usuarios', $userData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'usuario' => [
                         'nombre',
                         'contrasena',
                         'direccion',
                         'telefono',
                         'email',
                         'rol_id',
                     ]
                 ]);

        $this->assertDatabaseHas('usuarios', [
            'nombre' => 'Nombre de ejemplo',
            'email' => 'usuario@example.com',
        ]);
    }
    
    /** 
     * Monstrar usuarios.
     */
    public function testMostrarUsuario()
    {
        // Crea un usuario en la base de datos
        $usuario = Usuario::factory()->create();
        $usuarioId = $usuario->usuario_id;

        // Realiza una solicitud para mostrar el usuario con el ID específico
        $response = $this->get("/api/usuarios/{$usuarioId}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se puede eliminar correctamente.
     */
    public function testEliminarUsuario()
    {
        // Crear manualmente un usuario en la base de datos
        $usuario = Usuario::create([
            'nombre' => 'Nombre', 
            'contrasena' => '123', 
            'direccion' => 'Dirección',
            'telefono' => '123456789',
            'email' => 'usuario@example.com',
            'rol_id' => 1,
        ]);

        // Obtener el ID del usuario creado
        $usuarioId = $usuario->usuario_id;

        // Realizar una solicitud DELETE para eliminar el usuario
        $response = $this->delete("/api/usuarios/{$usuarioId}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar un usuario inexistente.
     */
    public function testEliminarUsuarioInexistente()
    {
        // Intentar eliminar un usuario inexistente
        $response = $this->delete("/api/usuarios/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}