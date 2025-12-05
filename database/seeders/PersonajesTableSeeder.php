<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonajesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('personajes')->truncate();

        $personajes = [
            [
                'nombre' => 'Link',
                'descripcion' => 'El valiente héroe de Hyrule en la saga The Legend of Zelda.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/link.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Mario',
                'descripcion' => 'El icónico fontanero de Nintendo que protagoniza Super Mario.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/mario.png',
                'franquicia_id' => '2',
            ],
            [
                'nombre' => 'Solid Snake',
                'descripcion' => 'Espía legendario y soldado de élite en la serie Metal Gear Solid.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/solid_snake.png',
                'franquicia_id' => '3',
            ],
            [
                'nombre' => 'Donkey Kong',
                'descripcion' => 'El poderoso gorila protagonista de la franquicia Donkey Kong.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/donkey_kong.png',
                'franquicia_id' => '4',
            ],
            [
                'nombre' => 'Joker',
                'descripcion' => 'El líder de los Ladrones Fantasma en Persona 5.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/joker_p5.png',
                'franquicia_id' => '5',
            ],
            [
                'nombre' => 'Doom Slayer',
                'descripcion' => 'Guerrero imparable que elimina hordas de demonios en Doom.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/doomslayer.png',
                'franquicia_id' => '6',
            ],
            [
                'nombre' => 'Chell',
                'descripcion' => 'La silenciosa protagonista que desafía a GLaDOS en Portal.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/chell.png',
                'franquicia_id' => '7',
            ],
            [
                'nombre' => 'Arthur Morgan',
                'descripcion' => 'Forajido leal y protagonista de Red Dead Redemption 2.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/arthur_morgan.png',
                'franquicia_id' => '9',
            ],
            [
                'nombre' => 'Zelda',
                'descripcion' => 'La sabia princesa de Hyrule, portadora del poder de la Diosa y figura central en la saga.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/zelda.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Ganondorf',
                'descripcion' => 'El principal antagonista de la saga, un poderoso hechicero y rey de los Gerudo.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/ganondorf.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Impa',
                'descripcion' => 'Guardián leal de la familia real de Hyrule y protectora de la princesa Zelda.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/impa.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Skull Kid',
                'descripcion' => 'Una criatura traviesa del Bosque Perdido, conocida por causar caos con la Máscara de Majora.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/skull_kid.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Demise',
                'descripcion' => 'El ancestral demonio que representa la fuente original del mal en Hyrule.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/demise.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Fi',
                'descripcion' => 'El espíritu de la Espada Maestra, guía leal de Link en su misión divina.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/fi.png',
                'franquicia_id' => '1',
            ],
            [
                'nombre' => 'Master Hand',
                'descripcion' => 'La mano maestra que controla el escenario en Super Smash Bros.',
                'imagen' => 'https://alpalodevs.net/storage/personajes/master_hand.png',
                'franquicia_id' => '8',
            ],
        ];

        DB::table('personajes')->insert($personajes);
    }
}

