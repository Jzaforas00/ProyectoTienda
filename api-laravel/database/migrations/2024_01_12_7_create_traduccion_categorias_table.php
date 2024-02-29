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
        Schema::create('traduccion_categorias', function (Blueprint $table) {
            $table->id('traduccion_id');
            $table->string('nombre_traducido');

            $table->foreignId('categoria_id')
                    ->nullable()
                    ->constrained('categorias', 'categoria_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignId('idioma_id')
                    ->nullable()
                    ->constrained('idiomas', 'idioma_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traduccion_categorias');
    }
};
