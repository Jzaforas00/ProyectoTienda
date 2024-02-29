<?php

namespace Tests\Feature\TraduccionProducto;

use App\Models\TraduccionProducto;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTraduccionProductoControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas las traduccionesC.
     */
    public function testListarTraduccionesP()
    {
        TraduccionProducto::factory()->count(3)->create();

        $response = $this->get('/api/traduccionProductos');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'TraduccionP'
                 ]);
    }
    
    /** 
     * Crear una nueva traduccionP.
     */
    public function testCrearTraduccionesP()
    {
        $traduccionPData = [
            'producto_id' => 1, 'idioma_id' => 1, 'nombre_traducido' => 'Papapa',
            'descripcion_traducida' => 'Papapapapapapapa',
        ];

        // Realizar la solicitud para crear una nueva traduccionP
        $response = $this->postJson('/api/traduccionProductos', $traduccionPData);

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure([
                    'status',
                    'message',
                    'TraduccionP' => [
                        'producto_id',
                        'idioma_id',
                        'nombre_traducido',
                        'descripcion_traducida',
                    ]
                ]);
    }
    
    /** 
     * Monstrar traduccionesC.
     */
    public function testMostrarTraduccionesP()
    {
        // Crea una traduccionP en la base de datos
        $traduccionP = TraduccionProducto::factory()->create();
        $traduccionPID = $traduccionP->traduccion_id;

        // Realiza una solicitud para mostrar la traduccionP con el ID específico
        $response = $this->get("/api/traduccionProductos/{$traduccionPID}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarTraduccionesP()
    {
        // Crear manualmente una traduccionP en la base de datos
        $traduccionP = TraduccionProducto::create([
            'producto_id' => 2, 'idioma_id' => 2, 'nombre_traducido' => 'Popopo',
            'descripcion_traducida' => 'Popopopopopopopopopo',
        ]);

        // Obtener el ID de la traduccionP creada
        $traduccionPID = $traduccionP->traduccion_id;

        // Realizar una solicitud DELETE para eliminar la traduccionP
        $response = $this->delete("/api/traduccionProductos/{$traduccionPID}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar una traduccionP inexistente.
     */
    public function testEliminarTraduccionPInexistente()
    {
        // Intentar eliminar un traduccionP inexistente
        $response = $this->delete("/api/traduccionProductos/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}