<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('pedido_id');
            $table->integer('cantidad');
            $table->date('fecha_pedido');
            $table->decimal('precio_total');

            $table->foreignId('usuario_id')
                    ->nullable()
                    ->constrained('usuarios', 'usuario_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignId('producto_id')
                    ->nullable()
                    ->constrained('productos', 'producto_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
