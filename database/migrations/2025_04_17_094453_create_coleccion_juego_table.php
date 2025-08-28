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
        Schema::create('coleccion_juego', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coleccion_id')->constrained();
            $table->foreignId('juego_id')->constrained();
            $table->timestamps();

            $table->unique(['coleccion_id', 'juego_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion_juego');
    }
};
