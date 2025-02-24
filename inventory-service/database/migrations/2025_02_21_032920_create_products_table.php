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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nombre del producto (único)
            $table->decimal('price', 8, 2)->unsigned(); // Precio con dos decimales
            $table->text('description')->nullable(); // Descripción opcional
            $table->string('category', 50); // Categoría del producto
            $table->boolean('available')->default(true); // Disponibilidad por defecto true
            $table->json('ingredients'); // Ingredientes en formato JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
