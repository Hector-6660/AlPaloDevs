<?php

require __DIR__.'/juegos.php';
require __DIR__.'/usuarios.php';

// use App\Http\Controllers\API\JuegoController;
// use App\Http\Controllers\API\UsuarioController;
// use App\Http\Controllers\API\OpinioneController;
// use App\Http\Controllers\API\ColeccioneController;
// use App\Http\Controllers\API\FranquiciaController;
// use App\Http\Controllers\API\PersonajeController;
// use App\Http\Controllers\API\DemoController;

use App\Http\Controllers\JuegosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\OpinionesController;
use App\Http\Controllers\ColeccionesController;
use App\Http\Controllers\FranquiciasController;
use App\Http\Controllers\PersonajesController;
use App\Http\Controllers\DemosController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::prefix('v1')->group(function () {
    Route::get('{tabla}/count', function ($tabla) {
        return response()->json([
            'count' => DB::table($tabla)->count()
        ], 200);
    });

    // Búsqueda de opinión por usuario y juego
    Route::get('/opinions/buscar', [OpinionesController::class, 'buscarPorUsuarioYJuego']);

    // Rutas de la API
    Route::apiResource('juegos', JuegosController::class)->only(['index', 'show']);

    Route::get('franquicias', [FranquiciasController::class, 'index']);
    Route::get('franquicias/{id}', [FranquiciasController::class, 'show']);

    Route::get('personajes', [PersonajesController::class, 'index']);
    Route::get('personajes/{id}', [PersonajesController::class, 'show']);

    Route::get('demos', [DemosController::class, 'index']);
    Route::get('demos/{id}', [DemosController::class, 'show']);

    Route::apiResource('usuarios', UsuariosController::class);
    Route::apiResource('opinions', OpinionesController::class);
    Route::apiResource('coleccions', ColeccionesController::class);

    // Rutas adicionales
    Route::get('franquicias/{franquicia}/personajes', [PersonajesController::class, 'personajesPorFranquicia']);
    Route::get('juegos/{franquicia}/franquicia', [JuegosController::class, 'juegosPorFranquicia']);
    Route::get('juegos/{id}/demos', [JuegosController::class, 'demoPorJuego']);
    Route::get('juegos/{id}/opinions', [OpinionesController::class, 'opinionsPorJuego']);

    // Colecciones de un usuario (con juegos)
    Route::get('usuarios/{usuarioId}/colecciones', [ColeccionesController::class, 'coleccionesDeUsuario']);

    // Añadir/quitar juegos
    Route::post('coleccions/{coleccionId}/juegos/{juegoId}', [ColeccionesController::class, 'agregarJuego']);
    Route::delete('coleccions/{coleccionId}/juegos/{juegoId}', [ColeccionesController::class, 'quitarJuego']);

    // Login
    Route::post('/login', [UsuariosController::class, 'login']);

    // Rutas privadas
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::apiResource('juegos', JuegosController::class)->except(['index', 'show']);
        Route::apiResource('franquicias', FranquiciasController::class)->except(['index', 'show']);
        Route::apiResource('personajes', PersonajesController::class)->except(['index', 'show']);
        Route::apiResource('demos', DemosController::class)->except(['index', 'show']);
    });

    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });
});
