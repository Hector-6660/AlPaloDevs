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
                'imagen' => $juego['imagen'],
                'franquicia_nombre' => $juego['franquicia_nombre'],
            ]);

        }
        $this->command->info('¡Tablas categorias_ediciones, patrocinadores y juegos inicializada con datos!');
    }

    private static $juegos = [
        [
            'nombre' => 'Donkey Kong Bananza',
            'descripcion' => 'Un divertido juego de plataformas con el clásico simio recolectando bananas.',
            'fecha_lanzamiento' => '2025-07-15',
            'plataforma' => 'Nintendo Switch 2',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Donkey_Kong_Bananza.jpg',
            'franquicia_nombre' => 'Donkey Kong',
        ],
        [
            'nombre' => 'The Legend Of Zelda: Tears of the Kingdom',
            'descripcion' => 'La épica secuela de Breath of the Wild, en un mundo aún más amplio y vertical.',
            'fecha_lanzamiento' => '2023-05-12',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/The_Legend_Of_Zelda_Tears_Of_The_Kingdom.jpg',
            'franquicia_nombre' => 'The Legend Of Zelda',
        ],
        [
            'nombre' => 'Persona 5',
            'descripcion' => 'Un JRPG de simulación social y combate por turnos con temática de ladrones fantasma.',
            'fecha_lanzamiento' => '2016-09-15',
            'plataforma' => 'PlayStation 4',
            'genero' => 'JRPG',
            'autor' => 'Atlus',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Persona_5.jpg',
            'franquicia_nombre' => 'Persona',
        ],
        [
            'nombre' => 'Portal 2',
            'descripcion' => 'Juego de puzles en primera persona que desafía la física con portales.',
            'fecha_lanzamiento' => '2011-04-19',
            'plataforma' => 'PC, PlayStation 3, Xbox 360',
            'genero' => 'Puzles',
            'autor' => 'Valve',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Portal_2.jpg',
            'franquicia_nombre' => 'Portal',
        ],
        [
            'nombre' => 'Metal Gear Solid 2: Sons of Liberty',
            'descripcion' => 'Un juego de sigilo y acción con narrativa cinematográfica.',
            'fecha_lanzamiento' => '2001-11-13',
            'plataforma' => 'PlayStation 2',
            'genero' => 'Sigilo',
            'autor' => 'Konami',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Metal_Gear_Solid_2_Sons_Of_Liberty.jpg',
            'franquicia_nombre' => 'Metal Gear Solid',
        ],
        [
            'nombre' => 'Red Dead Redemption 2',
            'descripcion' => 'Un mundo abierto inmenso en el salvaje oeste, con una historia profunda y realista.',
            'fecha_lanzamiento' => '2018-10-26',
            'plataforma' => 'PlayStation 4, Xbox One, PC',
            'genero' => 'Sandbox',
            'autor' => 'Rockstar Games',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Red_Dead_Redemption_2.jpg',
            'franquicia_nombre' => 'Red Dead Redemption',
        ],
        [
            'nombre' => 'Super Smash Bros. Ultimate',
            'descripcion' => 'El crossover de lucha definitivo con personajes de múltiples franquicias de videojuegos.',
            'fecha_lanzamiento' => '2018-12-07',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Lucha',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Super_Smash_Bros_Ultimate.jpg',
            'franquicia_nombre' => 'Super Smash Bros.',
        ],
        [
            'nombre' => 'Super Mario Odyssey',
            'descripcion' => 'Una aventura 3D por múltiples mundos con Mario y su sombrero mágico Cappy.',
            'fecha_lanzamiento' => '2017-10-27',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Super_Mario_Odyssey.jpg',
            'franquicia_nombre' => 'Super Mario',
        ],
        [
            'nombre' => 'The Legend of Zelda: Ocarina of Time',
            'descripcion' => 'Una aventura atemporal considerada uno de los mejores videojuegos de la historia.',
            'fecha_lanzamiento' => '1998-11-21',
            'plataforma' => 'Nintendo 64',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/The_Legend_Of_Zelda_Ocarina_Of_Time.jpg',
            'franquicia_nombre' => 'The Legend Of Zelda',
        ],
        [
            'nombre' => 'DOOM Eternal',
            'descripcion' => 'Un frenético shooter en primera persona donde luchas contra hordas demoníacas.',
            'fecha_lanzamiento' => '2020-03-20',
            'plataforma' => 'PC, PlayStation 4, Xbox One, Nintendo Switch',
            'genero' => 'FPS',
            'autor' => 'id Software',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Doom_Eternal.jpg',
            'franquicia_nombre' => 'Doom',
        ],
    ];
}
