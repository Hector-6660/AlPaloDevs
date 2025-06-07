<?php

use App\Http\Controllers\API\JuegoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OpinionesController;
use App\Http\Controllers\ColeccionesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::prefix('v1')->group(function () {
    Route::get('{tabla}/count', function ($tabla) {
        return response()->json([
            'count' => DB::table($tabla)->count()
        ], 200);
    });
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('juegos', JuegoController::class);
    Route::apiResource('opinions', OpinionesController::class);
    Route::apiResource('coleccions', ColeccionesController::class);
    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });
});