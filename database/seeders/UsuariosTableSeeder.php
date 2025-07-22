<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->truncate();

        foreach (self::$usuarios as $usuario) {
            DB::table('usuarios')->insert([
                'nombre' => $usuario['nombre'],
                'nick' => $usuario['nick'],
                'email' => $usuario['email'],
                'password' => bcrypt($usuario['password']),
                'rol' => $usuario['rol'],
            ]);
        }
        $this->command->info('Tabla usuarios inicializada con datos!');
    }

    private static $usuarios = [];
}
