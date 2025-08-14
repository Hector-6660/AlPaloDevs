<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegosController;

Route::group(['prefix' => 'juegos'], function(){
    Route::get('/', [JuegosController::class, 'index']);
    Route::get('/show/{id}', [JuegosController::class, 'show']);
    Route::post('/store', [JuegosController::class, 'store']);
    Route::put('/update/{id}', [JuegosController::class, 'update']);
    Route::delete('/destroy/{id}', [JuegosController::class, 'destroy']);
});
