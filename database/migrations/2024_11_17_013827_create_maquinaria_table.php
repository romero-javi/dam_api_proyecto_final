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
        Schema::create('maquinaria', function (Blueprint $table) {
            $table->id(); // ID único para cada maquinaria
            $table->string('nombre'); // Nombre de la maquinaria
            $table->string('tipo'); // Tipo de maquinaria (por ejemplo, excavadora, grúa, etc.)
            $table->date('fecha_adquisicion'); // Fecha en que se adquirió la maquinaria
            $table->enum('estado', ['activo', 'en mantenimiento', 'inactivo'])->default('activo'); // Estado de la maquinaria
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinaria');
    }
};
