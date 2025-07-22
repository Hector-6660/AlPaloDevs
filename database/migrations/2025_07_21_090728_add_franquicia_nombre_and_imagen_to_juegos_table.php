<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('autor');
            $table->string('franquicia_nombre')->nullable()->after('imagen');

            // $table->foreign('franquicia_nombre')->references('nombre')->on('franquicias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            $table->dropColumn('franquicia_nombre');
            $table->dropColumn('imagen');

            // $table->dropForeign(['franquicia_nombre']);
        });
    }
};

