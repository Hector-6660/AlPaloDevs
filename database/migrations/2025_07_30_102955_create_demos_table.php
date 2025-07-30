<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('mainScript')->nullable();
            $table->unsignedBigInteger('juego_id')->unique();

            $table->foreign('juego_id')
                    ->references('id')
                    ->on('juegos')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demos');
    }
};
