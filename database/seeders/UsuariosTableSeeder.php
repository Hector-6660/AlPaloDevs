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
                'foto_perfil' => $usuario['foto_perfil'],
            ]);
        }
        $this->command->info('Tabla usuarios inicializada con datos!');
    }

    private static $usuarios = [
        [
            'nombre' => 'Al Palo Devs',
            'nick' => 'alPaloDevs',
            'email' => 'alpalodevs@gmail.com',
            'password' => 'password',
            'rol' => 'admin',
            'foto_perfil' => 'http://alpalodevs.test/storage/perfiles/alpalodevs.jpg',
        ],
    ];
}
