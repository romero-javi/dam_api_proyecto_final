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
        Schema::create('recursos_humanos', function (Blueprint $table) {
            $table->id(); // ID único para cada recurso humano
            $table->string('nombre'); // Nombre del empleado
            $table->string('puesto'); // Puesto o cargo del empleado
            $table->date('fecha_ingreso'); // Fecha de ingreso del empleado
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos_humanos');
    }
};
