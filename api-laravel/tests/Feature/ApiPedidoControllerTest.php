<?php

namespace Tests\Feature\Pedido;

use App\Models\Pedido;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiPedidoControllerTest extends TestCase
{

    /** @test */
    /** 
     * Listar todas los pedidos.
     */
    public function testListarPedidos()
    {
        Pedido::factory()->count(3)->create();

        $response = $this->get('/api/pedidos');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'pedido'
                 ]);
    }
    
    /** 
     * Crear un nuevo pedido.
     */
    public function testCrearPedidos()
    {
        $pedidoData = [
            'cantidad' => 200, 'fecha_pedido' => '2024-02-07', 'precio_total' => 200, 
            'usuario_id' => 1, 'producto_id' => 1,
        ];

        // Realizar la solicitud para crear un nuevo pedido
        $response = $this->postJson('/api/pedidos', $pedidoData);

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure([
                    'status',
                    'message',
                    'pedido' => [
                        'cantidad',
                        'fecha_pedido',
                        'precio_total',
                        'usuario_id',
                        'producto_id',
                    ]
                ]);
    }
    
    /** 
     * Monstrar pedidos.
     */
    public function testMostrarPedidos()
    {
        // Crea un pedido en la base de datos
        $pedido = Pedido::factory()->create();
        $pedidoID = $pedido->pedido_id;

        // Realiza una solicitud para mostrar el pedido con el ID específico
        $response = $this->get("/api/pedidos/{$pedidoID}");

        // Verifica que la solicitud se haya completado con éxito
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar que se pueden eliminar correctamente.
     */
    public function testEliminarPedidos()
    {
        // Crear manualmente un pedido en la base de datos
        $pedido = Pedido::create([
            'cantidad' => 22, 'fecha_pedido' => '2024-02-07',
            'precio_total' => 200, 'usuario_id' => 1, 'producto_id' => 2,
        ]);

        // Obtener el ID del pedido creado
        $pedidoID = $pedido->pedido_id;

        // Realizar una solicitud DELETE para eliminar el pedido
        $response = $this->delete("/api/pedidos/{$pedidoID}");

        // Verificar que la solicitud se haya completado con éxito (código de estado HTTP 200)
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test para verificar si se maneja correctamente un error al intentar eliminar un pedido inexistente.
     */
    public function testEliminarPedidoInexistente()
    {
        // Intentar eliminar un pedido inexistente
        $response = $this->delete("/api/pedidos/999");

        // Verificar que la solicitud falle con un código de estado HTTP 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
    
}