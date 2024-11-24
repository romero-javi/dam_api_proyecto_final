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
            $table->id('id_maquinaria');
            $table->string('nombre');
            $table->enum('estado', ['Disponible', 'Asignada', 'En mantenimiento'])->default('Disponible');
            $table->date('fecha_ultimo_mantenimiento');
            $table->date('fecha_adquisicion');
            $table->string('tipo');
            $table->decimal('costo_diario', 13, 2);
            $table->timestamps();
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
