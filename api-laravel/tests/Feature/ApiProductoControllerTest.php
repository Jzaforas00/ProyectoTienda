<?php

namespace Tests\Feature\Producto;

use App\Models\Producto;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiProductoControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas los productos.
     */
    public function testListarProductos()
    {
        Producto::factory()->count(3)->create();

        $response = $this->get('/api/productos');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'producto'
                 ]);
    }
    
    /** 
     * Crear un nuevo producto.
     */
    public function testCrearProductos()
    {
        $productoData = [
            'precio' => 200, 'stock' => 33, 'imagen_url' => 'ejemplo url', 'categoria_id' => 2,
        ];

        $response = $this->postJson('/api/productos', $productoData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'producto' => [
                         'precio',
                         'stock',
                         'imagen_url',
                         'categoria_id',
                     ]
                 ]);
    }
    
    /** 
     * Monstrar productos.
     */
    public function testMostrarProductos()
    {
        // Crea un producto en la base de datos
        $producto = Producto::factory()->create();
        $productoId = $producto->producto_id;

        // Realiza una solicitud para mostrar el producto con el ID específico
        $response = $this->get("/api/productos/{$productoId}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarProducto()
    {
        // Crear manualmente un producto en la base de datos
        $producto = Producto::create([
            'precio' => 200, 'stock' => 33, 'imagen_url' => 'ejemplo url', 'categoria_id' => 2,
        ]);

        // Obtener el ID del producto creado
        $productoId = $producto->producto_id;

        // Realizar una solicitud DELETE para eliminar el producto
        $response = $this->delete("/api/productos/{$productoId}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar un producto inexistente.
     */
    public function testEliminarProductoInexistente()
    {
        // Intentar eliminar un producto inexistente
        $response = $this->delete("/api/productos/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}