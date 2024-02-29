<?php

namespace Tests\Feature\Idioma;

use App\Models\Idioma;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiIdiomaControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas los idiomas.
     */
    public function testListarIdiomas()
    {
        Idioma::factory()->count(3)->create();

        $response = $this->get('/api/idiomas');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'idiomas'
                 ]);
    }
    
    /** 
     * Crear un nuevo idioma.
     */
    public function testCrearIdiomas()
    {
        $idiomaData = [
            'nombre' => 'Idioma Ejemplo',
        ];

        $response = $this->postJson('/api/idiomas', $idiomaData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'idioma' => [
                         'nombre',
                     ]
                 ]);
    }
    
    /** 
     * Monstrar idiomas.
     */
    public function testMostrarIidomas()
    {
        // Crea un idioma en la base de datos
        $idioma = Idioma::factory()->create();
        $idomaId = $idioma->idioma_id;

        // Realiza una solicitud para mostrar el idioma con el ID específico
        $response = $this->get("/api/idiomas/{$idomaId}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarIdioma()
    {
        // Crear manualmente un idioma en la base de datos
        $idioma = Idioma::create([
            'nombre' => 'Esperanto',
        ]);

        // Obtener el ID del idioma creado
        $idiomaId = $idioma->idioma_id;

        // Realizar una solicitud DELETE para eliminar el idioma
        $response = $this->delete("/api/idiomas/{$idiomaId}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar un idioma inexistente.
     */
    public function testEliminarIdiomaInexistente()
    {
        // Intentar eliminar un idioma inexistente
        $response = $this->delete("/api/idiomas/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}