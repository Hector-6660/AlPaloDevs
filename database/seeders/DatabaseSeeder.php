<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // AuthUser::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Model::unguard();
        Schema::disableForeignKeyConstraints();
        $this->call(JuegosTableSeeder::class);

        $this->command->info('Tablas inicializadas con datos!');

        Model::reguard();
        Schema::enableForeignKeyConstraints();
    }
}
