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
        Schema::create('materia_prima_proyecto', function (Blueprint $table) {
            $table->id("id_asignacion");
            $table->foreignId  ('materia_prima_id_materia_prima')->references('id_materia_prima')->on('materia_prima')->onDelete('cascade');
            $table->foreignId  ('proyecto_id_proyecto')->references('id_proyecto')->on('proyecto')->onDelete('cascade');
            $table->date("fecha_asignacion");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_prima_proyecto');
    }
};
