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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre');
            $table->string('contacto');
            $table->string('direccion');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->date('fecha_registro');
            $table->timestamps();
        }); 
    }

    /**direccion
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
