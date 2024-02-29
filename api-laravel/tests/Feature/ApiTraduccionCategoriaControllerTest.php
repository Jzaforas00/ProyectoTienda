<?php

namespace Tests\Feature\TraduccionCategoria;

use App\Models\TraduccionCategoria;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTraduccionCategoriaControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas las traduccionesC.
     */
    public function testListarTraduccionesC()
    {
        TraduccionCategoria::factory()->count(3)->create();

        $response = $this->get('/api/traduccionCategorias');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'TraduccionC'
                 ]);
    }
    
    /** 
     * Crear una nueva traduccionC.
     */
    public function testCrearTraduccionesC()
    {
        $traduccionCData = [
            'categoria_id' => 1, 'idioma_id' => 1, 'nombre_traducido' => 'Papapa', 
        ];

        // Realizar la solicitud para crear una nueva traduccionC
        $response = $this->postJson('/api/traduccionCategorias', $traduccionCData);

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure([
                    'status',
                    'message',
                    'TraduccionC' => [
                        'categoria_id',
                        'idioma_id',
                        'nombre_traducido',
                    ]
                ]);
    }
    
    /** 
     * Monstrar traduccionesC.
     */
    public function testMostrarTraduccionesC()
    {
        // Crea una traduccionC en la base de datos
        $traduccionC = TraduccionCategoria::factory()->create();
        $traduccionCID = $traduccionC->traduccion_id;

        // Realiza una solicitud para mostrar la traduccionC con el ID específico
        $response = $this->get("/api/traduccionCategorias/{$traduccionCID}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarTraduccionesC()
    {
        // Crear manualmente una traduccionC en la base de datos
        $traduccionC = TraduccionCategoria::create([
            'categoria_id' => 2, 'idioma_id' => 2, 'nombre_traducido' => 'Popopo',
        ]);

        // Obtener el ID de la traduccionC creada
        $traduccionCID = $traduccionC->traduccion_id;

        // Realizar una solicitud DELETE para eliminar la traduccionC
        $response = $this->delete("/api/traduccionCategorias/{$traduccionCID}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar una traduccionC inexistente.
     */
    public function testEliminarTraduccionCInexistente()
    {
        // Intentar eliminar un traduccionC inexistente
        $response = $this->delete("/api/traduccionCategorias/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}