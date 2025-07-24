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
            'descripcion' => "In this game, Donkey Kong explores and descends through increasingly deeper layers of the underground world in search of Void Company, a group of evil primates. The game places a strong emphasis on Donkey Kong’s brute strength, allowing him to perform a variety of moves to overcome obstacles, dislodge tough objects, and even dig through the level’s terrain. Thematically, the game revolves around rocks, minerals, and the concept of mining, introducing a wide array of sentient stone creatures. While some serve as enemies, one such creature is friendly and assists Donkey Kong throughout his journey. Although the game takes place underground, many locations appear to have open skies, adding to the fantastical nature of the setting.",
            'fecha_lanzamiento' => '2025-07-15',
            'plataforma' => 'Nintendo Switch 2',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Donkey_Kong_Bananza.jpg',
            'franquicia_nombre' => 'Donkey Kong',
        ],
        [
            'nombre' => 'The Legend Of Zelda: Tears of the Kingdom',
            'descripcion' => "The Legend of Zelda: Tears of the Kingdom is a 2023 action-adventure game developed and published by Nintendo. It is the sequel to The Legend of Zelda: Breath of the Wild. The player once again controls Link, who must help Princess Zelda to stop Ganondorf from destroying Hyrule. The game was conceived after ideas for Breath of the Wild's DLC had exceeded its scope. Tears of the Kingdom retains the open-world action-adventure gameplay of Hyrule from the previous game, adding two new areas, the Sky Islands and the Depths, as well as new Zonai devices, which the player can use for combat, propulsion, exploration, and more.",
            'fecha_lanzamiento' => '2023-05-12',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/The_Legend_Of_Zelda_Tears_Of_The_Kingdom.jpg',
            'franquicia_nombre' => 'The Legend Of Zelda',
        ],
        [
            'nombre' => 'Persona 5',
            'descripcion' => "Persona 5 is an Urban Fantasy Role-Playing Game, and the fourth numbered sequel in the Shin Megami Tensei JRPG franchise's Persona sub-series, developed by Atlus for PlayStation 3 and PlayStation 4. It is the first mainline entry in the Persona franchise following Sega's purchase of Atlus in 2013 and the first numbered Persona game to launch on multiple consoles. The game was released in Japan on September 15, 2016, in Traditional Chinese on March 23, 2017, with an English dub in the Americas and Europe on April 4 2017, and in South Korea on June 8 2017.",
            'fecha_lanzamiento' => '2016-09-15',
            'plataforma' => 'PlayStation 4',
            'genero' => 'JRPG',
            'autor' => 'Atlus',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Persona_5.jpg',
            'franquicia_nombre' => 'Persona',
        ],
        [
            'nombre' => 'Portal 2',
            'descripcion' => "Portal 2 is a first-person puzzle-platform game developed by Valve Corporation. It is the sequel to the 2007 game Portal, and was released for Microsoft Windows, OS X, Xbox 360, and PlayStation 3 in April 2011. The game expands on the gameplay mechanics of its predecessor, introducing new elements such as gels that affect player movement and portals that can be placed on any surface. The story follows Chell, who is guided by a personality core named Wheatley and later encounters the malevolent AI GLaDOS.",
            'fecha_lanzamiento' => '2011-04-19',
            'plataforma' => 'PC, PlayStation 3, Xbox 360',
            'genero' => 'Puzles',
            'autor' => 'Valve',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Portal_2.jpg',
            'franquicia_nombre' => 'Portal',
        ],
        [
            'nombre' => 'Metal Gear Solid 2: Sons of Liberty',
            'descripcion' => "Metal Gear Solid 2: Sons of Liberty is an action-adventure stealth game developed by Konami. It is the sequel to the original Metal Gear Solid and was released for PlayStation 2 in 2001. The game follows Solid Snake and Raiden as they attempt to stop a terrorist threat.",
            'fecha_lanzamiento' => '2001-11-13',
            'plataforma' => 'PlayStation 2',
            'genero' => 'Sigilo',
            'autor' => 'Konami',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Metal_Gear_Solid_2_Sons_Of_Liberty.jpg',
            'franquicia_nombre' => 'Metal Gear Solid',
        ],
        [
            'nombre' => 'Red Dead Redemption 2',
            'descripcion' => "Red Dead Redemption 2 is an epic tale of life in America’s unforgiving heartland. The game follows the story of Arthur Morgan, an outlaw and a member of the Van der Linde gang, as they navigate the challenges of a changing world. With stunning visuals, a rich narrative, and a vast open world to explore, Red Dead Redemption 2 offers an immersive gaming experience.",
            'fecha_lanzamiento' => '2018-10-26',
            'plataforma' => 'PlayStation 4, Xbox One, PC',
            'genero' => 'Sandbox',
            'autor' => 'Rockstar Games',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Red_Dead_Redemption_2.jpg',
            'franquicia_nombre' => 'Red Dead Redemption',
        ],
        [
            'nombre' => 'Super Smash Bros. Ultimate',
            'descripcion' => "Super Smash Bros. Ultimate is a crossover fighting game featuring characters from various Nintendo franchises and third-party games. It includes every character from previous games in the series, along with new fighters and stages. The game emphasizes fast-paced combat and offers a variety of modes for both single-player and multiplayer experiences.",
            'fecha_lanzamiento' => '2018-12-07',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Lucha',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Super_Smash_Bros_Ultimate.jpg',
            'franquicia_nombre' => 'Super Smash Bros.',
        ],
        [
            'nombre' => 'Super Mario Odyssey',
            'descripcion' => "Super Mario Odyssey is a 3D platform game where players control Mario as he travels across various kingdoms to rescue Princess Peach from Bowser. The game introduces new gameplay mechanics, including the ability to capture and control enemies and objects using Mario's hat, Cappy.",
            'fecha_lanzamiento' => '2017-10-27',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Super_Mario_Odyssey.jpg',
            'franquicia_nombre' => 'Super Mario',
        ],
        [
            'nombre' => 'The Legend of Zelda: Ocarina of Time',
            'descripcion' => "The Legend of Zelda: Ocarina of Time is an action-adventure game that follows Link as he embarks on a quest to stop the evil king Ganondorf. The game features a vast open world, puzzle-solving elements, and real-time combat. It is widely regarded as one of the greatest video games of all time.",
            'fecha_lanzamiento' => '1998-11-21',
            'plataforma' => 'Nintendo 64',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'http://alpalodevs.test/storage/portadas/The_Legend_Of_Zelda_Ocarina_Of_Time.jpg',
            'franquicia_nombre' => 'The Legend Of Zelda',
        ],
        [
            'nombre' => 'DOOM Eternal',
            'descripcion' => "DOOM Eternal is a first-person shooter game developed by id Software and published by Bethesda Softworks. It is the sequel to the 2016 game DOOM and continues the story of the Doom Slayer as he battles demonic forces across various locations, including Earth and Hell. The game features fast-paced combat, platforming elements, and a variety of weapons and abilities.",
            'fecha_lanzamiento' => '2020-03-20',
            'plataforma' => 'PC, PlayStation 4, Xbox One, Nintendo Switch',
            'genero' => 'FPS',
            'autor' => 'id Software',
            'imagen' => 'http://alpalodevs.test/storage/portadas/Doom_Eternal.jpg',
            'franquicia_nombre' => 'Doom',
        ],
    ];
}
