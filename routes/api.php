<?php

require __DIR__.'/juegos.php';

// use App\Http\Controllers\API\JuegoController;
// use App\Http\Controllers\API\UsuarioController;
// use App\Http\Controllers\API\OpinioneController;
// use App\Http\Controllers\API\ColeccioneController;
// use App\Http\Controllers\API\FranquiciaController;
// use App\Http\Controllers\API\PersonajeController;

use App\Http\Controllers\JuegosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\OpinionesController;
use App\Http\Controllers\ColeccionesController;
use App\Http\Controllers\FranquiciasController;
use App\Http\Controllers\PersonajesController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::prefix('v1')->group(function () {
    Route::get('{tabla}/count', function ($tabla) {
        return response()->json([
            'count' => DB::table($tabla)->count()
        ], 200);
    });
    Route::apiResource('usuarios', UsuariosController::class);
    Route::apiResource('juegos', JuegosController::class);
    Route::apiResource('opinions', OpinionesController::class);
    Route::apiResource('coleccions', ColeccionesController::class);
    Route::apiResource('franquicias', FranquiciasController::class);
    Route::apiResource('personajes', PersonajesController::class);

    Route::get('franquicias/{franquicia}/personajes', [PersonajesController::class, 'personajesPorFranquicia']);
    Route::get('juegos/{franquicia}/franquicia', [JuegosController::class, 'juegosPorFranquicia']);

    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });
});
