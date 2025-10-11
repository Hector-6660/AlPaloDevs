<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            // Quita la foreign key actual
            $table->dropForeign(['franquicia_id']);

            // Hace el campo nullable y sin restricción de integridad
            $table->unsignedBigInteger('franquicia_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            // En caso de rollback, restaura la foreign key original
            $table->unsignedBigInteger('franquicia_id')->nullable(false)->change();
            $table->foreign('franquicia_id')->references('id')->on('franquicias')->onDelete('cascade');
        });
    }
};

