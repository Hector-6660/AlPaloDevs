<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColeccionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table('coleccions')->truncate();

        foreach (self::$coleccions as $coleccion) {
            DB::table('coleccions')->insert([
                'nombre' => $coleccion['nombre'],
                'descripcion' => $coleccion['descripcion'],
                'usuario_id' => $coleccion['usuario_id'],
                'imagen' => $coleccion['imagen'],
            ]);
        }
        $this->command->info('Tabla coleccions inicializada con datos!');
    }

    private static $coleccions = [];
}
