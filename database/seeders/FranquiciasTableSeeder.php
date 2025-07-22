<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FranquiciasTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('franquicias')->truncate();

        $franquicias = [
            [
                'nombre' => 'The Legend of Zelda',
                'descripcion' => 'Una saga de aventuras épicas protagonizada por Link en el reino de Hyrule.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/zelda.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/the_legend_of_zelda_logo.png',
            ],
            [
                'nombre' => 'Super Mario',
                'descripcion' => 'Franquicia icónica de plataformas protagonizada por Mario y Luigi.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/mario.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/super_mario_logo.png',
            ],
            [
                'nombre' => 'Metal Gear Solid',
                'descripcion' => 'Serie de sigilo y espionaje militar creada por Hideo Kojima.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/metalgearsolid.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/metal_gear_solid_logo.png',
            ],
            [
                'nombre' => 'Donkey Kong',
                'descripcion' => 'Clásica franquicia de plataformas protagonizada por un gorila gigante.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/donkeykong.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/donkey_kong_logo.png',
            ],
            [
                'nombre' => 'Persona',
                'descripcion' => 'JRPG con elementos de simulación social y combates por turnos.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/persona.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/persona_logo.png',
            ],
            [
                'nombre' => 'Doom',
                'descripcion' => 'Franquicia pionera de los shooters en primera persona con demonios y acción intensa.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/doom.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/doom_logo.png',
            ],
            [
                'nombre' => 'Portal',
                'descripcion' => 'Juego de puzzles en primera persona centrado en portales y física.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/portal.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/portal_logo.png',
            ],
            [
                'nombre' => 'Super Smash Bros.',
                'descripcion' => 'Franquicia de lucha que reúne personajes de distintas sagas de videojuegos.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/smashbros.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/super_smash_bros_logo.png',
            ],
            [
                'nombre' => 'Red Dead Redemption',
                'descripcion' => 'Saga de acción en el viejo oeste con enfoque narrativo y mundo abierto.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/reddead.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/red_dead_redemption_logo.png',
            ],
        ];

        DB::table('franquicias')->insert($franquicias);
    }
}

