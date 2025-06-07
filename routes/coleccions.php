<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColeccionesController;

Route::group(['prefix' => 'colecciones'], function(){
    Route::get('/', [ColeccionesController::class, 'index']);
    Route::get('/show/{id}', [ColeccionesController::class, 'show']);
    Route::post('/store', [ColeccionesController::class, 'store']);
    Route::put('/update/{id}', [ColeccionesController::class, 'update']);
    Route::delete('/destroy/{id}', [ColeccionesController::class, 'destroy']);
});