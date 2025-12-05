<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('coleccions', function (Blueprint $table) {
            $table->string('imagen')->default('https://alpalodevs.net/storage/colecciones/default.jpg');
        });
    }

    public function down()
    {
        Schema::table('coleccions', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
