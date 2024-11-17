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
        Schema::create('materia_prima', function (Blueprint $table) {
            $table->id('id_materia_prima');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->decimal('costo', 13, 2);
            $table->timestamps();

            $table->unsignedBigInteger('id_proyecto');
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_prima');
    }
};
