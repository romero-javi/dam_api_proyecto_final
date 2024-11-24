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
        Schema::create('proyecto', function (Blueprint $table) {
            $table->id('id_proyecto');
            $table->string('ubicacion');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->decimal('porcentaje_avance', 4, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('inversion_inicial', 13, 2);
            $table->decimal('inversion_final', 13, 2);
            $table->decimal('costo_diario', 13, 2);
            $table->string('tipo_proyecto');
            $table->string('imagen_url');
            $table->string('inconvenientes');
            $table->boolean('notificaciones')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto');
    }
};
