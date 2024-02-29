<?php

namespace Tests\Feature\Categoria;

use App\Models\Categoria;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiCategoriaControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas las categorias.
     */
    public function testListarCategorias()
    {
        Categoria::factory()->count(3)->create();

        $response = $this->get('/api/categorias');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'categoria'
                 ]);
    }
    
    /** 
     * Crear una nueva categoria.
     */
    public function testCrearCategorias()
    {
        $categoryData = [
            'url_imagen' => 'Url ejemplo',
        ];

        $response = $this->postJson('/api/categorias', $categoryData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'categoria' => [
                         'url_imagen',
                     ]
                 ]);
    }
    
    /** 
     * Monstrar categorias.
     */
    public function testMostrarCategorias()
    {
        // Crea una categoria en la base de datos
        $categoria = Categoria::factory()->create();
        $categoriaId = $categoria->categoria_id;

        // Realiza una solicitud para mostrar la categoria con el ID específico
        $response = $this->get("/api/categorias/{$categoriaId}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarCategoria()
    {
        // Crear manualmente una categoria en la base de datos
        $categoria = Categoria::create([
            'url_imagen' => 'URLejemplo',
        ]);

        // Obtener el ID de la categoria creada
        $categoriaId = $categoria->categoria_id;

        // Realizar una solicitud DELETE para eliminar la categoria
        $response = $this->delete("/api/categorias/{$categoriaId}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar una categoria inexistente.
     */
    public function testEliminarCategoriaInexistente()
    {
        // Intentar eliminar una categoria inexistente
        $response = $this->delete("/api/categorias/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}