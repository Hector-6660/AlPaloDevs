<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('demos')->truncate();

        foreach (self::$demos as $demo) {
            DB::table('demos')->insert([
                'nombre' => $demo['nombre'],
                'imagen' => $demo['imagen'],
                'mainScript' => $demo['mainScript'],
                'juego_id' => $demo['juego_id'],
            ]);

        }
        $this->command->info('¡Tabla demos inicializada con datos!');
    }

    private static $demos = [
        [
            'nombre' => 'Donkey Kong Bananza Demo',
            'imagen' => 'http://alpalodevs.net/storage/demos/portadas/Donkey_Kong_Bananza_Demo.jpg',
            'mainScript' => 'http://alpalodevs.net/storage/demos/donkey-kong-bananza-demo/main.js',
            'juego_id' => 1,
        ],
    ];
}
