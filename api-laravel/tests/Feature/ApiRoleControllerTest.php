<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiRoleControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas los roles.
     */
    public function testListarRoles()
    {
        Role::factory()->count(3)->create();

        $response = $this->get('/api/roles');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'rol'
                 ]);
    }
    
    /** 
     * Crear un nuevo rol.
     */
    public function testCrearRoles()
    {
        $rolData = [
            'nombre' => 'Rol Ejemplo',
        ];

        $response = $this->postJson('/api/roles', $rolData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'rol' => [
                         'nombre',
                     ]
                 ]);
    }
    
    /** 
     * Monstrar roles.
     */
    public function testMostrarRoles()
    {
        // Crea un rol en la base de datos
        $rol = Role::factory()->create();
        $rolId = $rol->rol_id;

        // Realiza una solicitud para mostrar el rol con el ID específico
        $response = $this->get("/api/roles/{$rolId}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarRol()
    {
        // Crear manualmente un rol en la base de datos
        $rol = Role::create([
            'nombre' => 'Esperanto',
        ]);

        // Obtener el ID del rol creado
        $rolId = $rol->rol_id;

        // Realizar una solicitud DELETE para eliminar el rol
        $response = $this->delete("/api/roles/{$rolId}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar un rol inexistente.
     */
    public function testEliminarRolInexistente()
    {
        // Intentar eliminar un rol inexistente
        $response = $this->delete("/api/roles/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}