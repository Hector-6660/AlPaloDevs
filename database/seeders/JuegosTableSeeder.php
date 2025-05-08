<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuegosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('juegos')->truncate();

        foreach (self::$juegos as $juego) {
            DB::table('juegos')->insert([
                'nombre' => $juego['nombre'],
                'descripcion' => $juego['descripcion'],
                'fecha_lanzamiento' => $juego['fecha_lanzamiento'],
                'plataforma' => $juego['plataforma'],
                'genero' => $juego['genero'],
                'autor' => $juego['autor'],
            ]);
        }
        $this->command->info('¡Tablas categorias_ediciones, patrocinadores y juegos inicializada con datos!');
    }

    private static $juegos = [
        [
            'nombre' => 'The Legend of Zelda: Breath of the Wild',
            'descripcion' => 'Un juego de aventuras en un mundo abierto.',
            'fecha_lanzamiento' => '2017-03-03',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
        ],
        [
            'nombre' => 'God of War Ragnarok',
            'descripcion' => 'La continuación del viaje de Kratos y Atreus.',
            'fecha_lanzamiento' => '2022-11-09',
            'plataforma' => 'PlayStation 5',
            'genero' => 'Acción',
            'autor' => 'Santa Monica Studio',
        ],
    ];
}
