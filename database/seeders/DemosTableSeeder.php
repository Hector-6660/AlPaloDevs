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
                'mainScript' => $demo['mainScript'],
                'juego_id' => $demo['juego_id'],
            ]);

        }
        $this->command->info('¡Tabla demos inicializada con datos!');
    }

    private static $demos = [
        [
            'nombre' => 'Donkey Kong Bananza Demo',
            'mainScript' => 'http://alpalodevs.test/storage/demos/donkey-kong-bananza-demo/main.js',
            'juego_id' => 1,
        ],
    ];
}
