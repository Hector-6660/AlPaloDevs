<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('opinions')->truncate();

        foreach (self::$opinions as $opinion) {
            DB::table('opinions')->insert([
                'titulo' => $opinion['titulo'],
                'contenido' => $opinion['contenido'],
                'puntuacion' => $opinion['puntuacion'],
                'usuario_id' => $opinion['usuario_id'],
                'juego_id' => $opinion['juego_id'],
            ]);
        }
        $this->command->info('Tabla opiniones inicializada con datos!');
    }

    private static $opinions = [];
}
