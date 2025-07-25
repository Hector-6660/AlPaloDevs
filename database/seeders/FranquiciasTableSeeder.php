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
                'descripcion' => 'The Legend of Zelda (ゼルダの伝説でんせつ Zeruda no Densetsu?, tdl. «La leyenda de Zelda») es una serie de videojuegos de acción-aventura creada por los diseñadores japoneses Shigeru Miyamoto y Takashi Tezuka,[1]​ y desarrollada por Nintendo, empresa que también se encarga de su distribución internacional. Su trama por lo general describe las heroicas aventuras del joven guerrero Link, que debe enfrentarse a peligros y resolver acertijos para ayudar a la Princesa Zelda a derrotar a Ganondorf y salvar su hogar, el reino de Hyrule. La serie es conocida por su jugabilidad de mundo abierto, exploración y resolución de acertijos, así como por su narrativa épica y personajes memorables.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/zelda.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/the_legend_of_zelda_logo.png',
            ],
            [
                'nombre' => 'Super Mario',
                'descripcion' => 'Super Mario (スーパーマリオ Sūpā Mario?) (también conocido como Super Mario Bros. y Mario) es una serie de videojuegos de plataformas creada por Nintendo protagonizada por su mascota, Mario. Es la serie central de la gran franquicia de Mario. Se ha lanzado al menos un juego de Super Mario para todas las principales consolas de videojuegos de Nintendo. Sin embargo, también se han lanzado varios videojuegos de Super Mario en plataformas de juegos que no son de Nintendo. Hay más de 20 juegos de la serie. La serie ha vendido más de 368 millones de copias en todo el mundo, lo que la convierte en la serie de videojuegos más vendida de todos los tiempos.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/mario.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/super_mario_logo.png',
            ],
            [
                'nombre' => 'Metal Gear Solid',
                'descripcion' => 'Metal Gear (メタルギア Metaru Gia?) es una serie de videojuegos creada por Hideo Kojima, desarrollada y publicada por la compañía Konami, en la que el jugador toma el control de un soldado de élite, experto en tácticas de combate, supervivencia y sigilo, cuyo nombre de operaciones es Snake (en español: «Serpiente»). Dependiendo de qué juego de la saga se trate, este nombre de operativo está atribuido a diversos personajes relacionados entre sí por la trama de la serie. La serie se centra en la lucha contra el Metal Gear, un tanque bípede capaz de lanzar misiles nucleares desde cualquier lugar del mundo, y en la lucha contra los diversos antagonistas que aparecen a lo largo de la saga.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/metalgearsolid.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/metal_gear_solid_logo.png',
            ],
            [
                'nombre' => 'Donkey Kong',
                'descripcion' => 'Donkey Kong[a]​ es una serie de videojuegos y una franquicia creada por el diseñador japonés Shigeru Miyamoto para Nintendo. Sigue las aventuras de Donkey Kong, un gorila grande y poderoso, y otros miembros de la familia de simios Kong. Los juegos de Donkey Kong incluyen la trilogía original de arcade de Nintendo R&D1; la serie Donkey Kong Country de Rare y Retro Studios; y la serie Mario vs. Donkey Kong de Nintendo Software Technology. Varios estudios han desarrollado juegos derivados en géneros como el entretenimiento educativo, los puzles, las carreras y el ritmo. La franquicia también incluye animación, medios impresos, parques temáticos y comercialización.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/donkeykong.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/donkey_kong_logo.png',
            ],
            [
                'nombre' => 'Persona',
                'descripcion' => 'Persona (ペルソナ Perusona?) (también conocida como: Shin Megami Tensei: Persona) es una serie de videojuegos RPG desarrollados y publicados por Atlus.[1]​ Esta saga es un spin-off de la serie de videojuegos Megami Tensei, la serie Persona se centra sobre grupos de adolescentes que tienen la habilidad de invocar facetas de sus psiques conocidas como "Personas". El juego toma elementos de la psicología analítica y varios de la pedagogía arquetipal. La serie tomó un cambio drástico en diseño durante Shin Megami Tensei: Persona 3 el cual introdujo elementos de simulación social a la serie, los cuales continuaron en Shin Megami Tensei: Persona 4. Cada juego de la serie utiliza un método diferente de invocar Personas como pistolas en Shin Megami Tensei: Persona 3. cartas de tarot en Shin Megami Tensei: Persona 4 o máscaras en Persona 5',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/persona.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/persona_logo.png',
            ],
            [
                'nombre' => 'Doom',
                'descripcion' => 'La franquicia Doom (estilizada DooM o DOOM) es una serie de videojuegos de disparos en primera persona creada por John Carmack, John Romero, Adrian Carmack, Kevin Cloud y Tom Hall, y desarrollada por id Software. Esta franquicia incluye novelas, cómics, juegos de mesa y adaptaciones cinematográficas. La serie se centra en las hazañas de un marine espacial no identificado que opera bajo las órdenes de la Union Aerospace Corporation (UAC), que lucha contra hordas de demonios y no muertos en el inframundo y la Tierra, protagonizando diversos viajes por portales entre ambos mundos.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/doom.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/doom_logo.png',
            ],
            [
                'nombre' => 'Portal',
                'descripcion' => 'Portal es una saga de videojuegos de plataformas y rompecabezas en primera persona desarrollada por Valve Corporation. La serie se centra en el uso de portales para resolver acertijos y avanzar a través de niveles, con un enfoque en la física y la mecánica del juego. El primer juego, Portal, fue lanzado como parte de The Orange Box en 2007, y su secuela, Portal 2, se lanzó en 2011. La serie es conocida por su innovador diseño de niveles, humor oscuro y la icónica inteligencia artificial GLaDOS.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/portal.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/portal_logo.png',
            ],
            [
                'nombre' => 'Super Smash Bros.',
                'descripcion' => 'Super Smash Bros. (大乱闘スマッシュブラザーズ Dairantou Sumasshu Burazāzu?, lit. Gran Estruendo de Hermanos) es una serie de videojuegos de lucha, creada por Masahiro Sakurai, quien dirigió todos los juegos, y distribuida por Nintendo, el cual presenta personajes invitados de franquicias establecidas en Nintendo y otras compañías de videojuegos y ha vendido en total más de 71 millones de unidades. La serie es conocida por su objetivo de jugabilidad único, que difiere de los juegos de pelea tradicionales, en donde el objetivo es aumentar contadores de daño y derribar a los oponentes del escenario en lugar de agotar las barras de salud.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/smashbros.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/super_smash_bros_logo.png',
            ],
            [
                'nombre' => 'Red Dead Redemption',
                'descripcion' => 'Red Dead Redemption es una serie de videojuegos de acción y aventura desarrollada por Rockstar Games. La serie se centra en la vida de forajidos y vaqueros en el Viejo Oeste americano, explorando temas de redención, traición y supervivencia. El primer juego, Red Dead Revolver, fue lanzado en 2004, seguido por Red Dead Redemption en 2010, que recibió aclamación crítica y comercial. La secuela, Red Dead Redemption 2, se lanzó en 2018, expandiendo la narrativa y el mundo del juego.',
                'imagen' => 'http://alpalodevs.test/storage/franquicias/reddead.jpg',
                'logo' => 'http://alpalodevs.test/storage/franquicias/logo/red_dead_redemption_logo.png',
            ],
        ];

        DB::table('franquicias')->insert($franquicias);
    }
}

