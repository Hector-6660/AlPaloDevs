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
                'franquicia_id' => isset($juego['franquicia_id']) ? (int) $juego['franquicia_id'] : null,
                'tiene_demo' => !empty($juego['tiene_demo']) ? 1 : 0,
            ]);

        }
        $this->command->info('¡Tabla juegos inicializada con datos!');
    }

    private static $juegos = [
        [
            'nombre' => 'Donkey Kong Bananza',
            'descripcion' => "En este juego, Donkey Kong explora y atraviesa capas cada vez más profundas del mundo subterráneo en busca de Void Company, un grupo de primates malvados. El juego pone mucho énfasis en la fuerza bruta de Donkey Kong, lo que le permite realizar una variedad de movimientos para atravesar obstáculos, desalojar objetos duros e incluso excavar el terreno del nivel.El juego se centra temáticamente en las rocas, los minerales y el concepto de minería, introduciendo una gran cantidad de criaturas pétreas sensitivas. Mientras que algunos actúan como enemigos, una de esas criaturas es amigable y ayuda a Donkey Kong a lo largo de su viaje. A pesar de que el juego tiene lugar bajo tierra, muchos lugares parecen tener un cielo abierto, lo que se suma a la naturaleza fantástica del escenario.",
            'fecha_lanzamiento' => '2025-07-15',
            'plataforma' => 'Nintendo Switch 2',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Donkey_Kong_Bananza.jpg',
            'franquicia_id' => '4',
            'tiene_demo' => true,
        ],
        [
            'nombre' => 'The Legend Of Zelda: Tears of the Kingdom',
            'descripcion' => "The Legend of Zelda: Tears of the Kingdom es un juego de acción y aventura de 2023 desarrollado y publicado por Nintendo. Es la secuela de The Legend of Zelda: Breath of the Wild. El jugador vuelve a controlar a Link, quien debe ayudar a la Princesa Zelda a detener a Ganondorf para evitar que destruya Hyrule. El juego surgió después de que las ideas para el contenido descargable de Breath of the Wild excedieran su alcance. Tears of the Kingdom conserva la jugabilidad de mundo abierto del Hyrule del juego anterior, añadiendo dos nuevas áreas: las Islas Celestes y las Profundidades, así como nuevos dispositivos Zonai, que el jugador puede usar para el combate, la propulsión, la exploración y más.",
            'fecha_lanzamiento' => '2023-05-12',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'https://alpalodevs.net/storage/portadas/The_Legend_Of_Zelda_Tears_Of_The_Kingdom.jpg',
            'franquicia_id' => '1',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Persona 5',
            'descripcion' => "Persona 5 es un juego de rol de fantasía urbana y la cuarta secuela numerada de la subserie Persona de la franquicia JRPG Shin Megami Tensei, desarrollado por Atlus para PlayStation 3 y PlayStation 4. Es la primera entrega principal de la franquicia Persona tras la compra de Atlus por parte de Sega en 2013, y el primer juego numerado de Persona en lanzarse en múltiples consolas. El juego fue lanzado en Japón el 15 de septiembre de 2016, en chino tradicional el 23 de marzo de 2017, con doblaje en inglés en América y Europa el 4 de abril de 2017, y en Corea del Sur el 8 de junio de 2017.",
            'fecha_lanzamiento' => '2016-09-15',
            'plataforma' => 'PlayStation 4',
            'genero' => 'JRPG',
            'autor' => 'Atlus',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Persona_5.jpg',
            'franquicia_id' => '5',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Portal 2',
            'descripcion' => "Portal 2 es un juego de plataformas y rompecabezas en primera persona desarrollado por Valve Corporation. Es la secuela del juego Portal de 2007 y fue lanzado para Microsoft Windows, OS X, Xbox 360 y PlayStation 3 en abril de 2011. El juego amplía las mecánicas de juego de su predecesor, introduciendo nuevos elementos como geles que afectan el movimiento del jugador y portales que pueden colocarse en cualquier superficie. La historia sigue a Chell, quien es guiada por un núcleo de personalidad llamado Wheatley y más tarde se encuentra con la malvada IA GLaDOS.",
            'fecha_lanzamiento' => '2011-04-19',
            'plataforma' => 'PC, PlayStation 3, Xbox 360',
            'genero' => 'Puzles',
            'autor' => 'Valve',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Portal_2.jpg',
            'franquicia_id' => '7',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Metal Gear Solid 2: Sons of Liberty',
            'descripcion' => "Metal Gear Solid 2: Sons of Liberty es un juego de sigilo y acción-aventura desarrollado por Konami. Es la secuela del Metal Gear Solid original y fue lanzado para PlayStation 2 en 2001. El juego sigue a Solid Snake y Raiden en su intento por detener una amenaza terrorista.",
            'fecha_lanzamiento' => '2001-11-13',
            'plataforma' => 'PlayStation 2',
            'genero' => 'Sigilo',
            'autor' => 'Konami',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Metal_Gear_Solid_2_Sons_Of_Liberty.jpg',
            'franquicia_id' => '3',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Red Dead Redemption 2',
            'descripcion' => "Red Dead Redemption 2 es una historia épica sobre la vida en el implacable corazón de América. El juego sigue la historia de Arthur Morgan, un forajido y miembro de la banda de Van der Linde, mientras enfrentan los desafíos de un mundo cambiante. Con gráficos impresionantes, una narrativa rica y un vasto mundo abierto por explorar, Red Dead Redemption 2 ofrece una experiencia de juego inmersiva.",
            'fecha_lanzamiento' => '2018-10-26',
            'plataforma' => 'PlayStation 4, Xbox One, PC',
            'genero' => 'Sandbox',
            'autor' => 'Rockstar Games',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Red_Dead_Redemption_2.jpg',
            'franquicia_id' => '9',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Super Smash Bros. Ultimate',
            'descripcion' => "Super Smash Bros. Ultimate es un juego de lucha crossover que presenta personajes de varias franquicias de Nintendo y de terceros. Incluye a todos los personajes de juegos anteriores de la serie, junto con nuevos luchadores y escenarios. El juego enfatiza el combate rápido y ofrece una variedad de modos para experiencias en solitario y multijugador.",
            'fecha_lanzamiento' => '2018-12-07',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Lucha',
            'autor' => 'Nintendo',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Super_Smash_Bros_Ultimate.jpg',
            'franquicia_id' => '8',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'Super Mario Odyssey',
            'descripcion' => "Super Mario Odyssey es un juego de plataformas en 3D donde los jugadores controlan a Mario mientras viaja por diversos reinos para rescatar a la Princesa Peach de Bowser. El juego introduce nuevas mecánicas de jugabilidad, incluida la habilidad de capturar y controlar enemigos y objetos usando el sombrero de Mario, Cappy.",
            'fecha_lanzamiento' => '2017-10-27',
            'plataforma' => 'Nintendo Switch',
            'genero' => 'Plataformas',
            'autor' => 'Nintendo',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Super_Mario_Odyssey.jpg',
            'franquicia_id' => '2',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'The Legend of Zelda: Ocarina of Time',
            'descripcion' => "The Legend of Zelda: Ocarina of Time es un juego de acción y aventura que sigue a Link en su misión por detener al malvado rey Ganondorf. El juego presenta un vasto mundo abierto, elementos de resolución de acertijos y combate en tiempo real. Es ampliamente considerado como uno de los mejores videojuegos de todos los tiempos.",
            'fecha_lanzamiento' => '1998-11-21',
            'plataforma' => 'Nintendo 64',
            'genero' => 'Aventura',
            'autor' => 'Nintendo',
            'imagen' => 'https://alpalodevs.net/storage/portadas/The_Legend_Of_Zelda_Ocarina_Of_Time.jpg',
            'franquicia_id' => '1',
            'tiene_demo' => false,
        ],
        [
            'nombre' => 'DOOM Eternal',
            'descripcion' => "DOOM Eternal es un juego de disparos en primera persona desarrollado por id Software y publicado por Bethesda Softworks. Es la secuela del juego DOOM de 2016 y continúa la historia del Doom Slayer mientras combate fuerzas demoníacas en diversas ubicaciones, incluyendo la Tierra y el Infierno. El juego presenta combates frenéticos, elementos de plataformas y una variedad de armas y habilidades.",
            'fecha_lanzamiento' => '2020-03-20',
            'plataforma' => 'PC, PlayStation 4, Xbox One, Nintendo Switch',
            'genero' => 'FPS',
            'autor' => 'id Software',
            'imagen' => 'https://alpalodevs.net/storage/portadas/Doom_Eternal.jpg',
            'franquicia_id' => '6',
            'tiene_demo' => false,
        ],
    ];
}
