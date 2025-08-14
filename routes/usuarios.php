<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::group(['prefix' => 'usuarios'], function(){
    Route::get('/', [UsuariosController::class, 'index']);
    Route::get('/show/{id}', [UsuariosController::class, 'show']);
    Route::post('/store', [UsuariosController::class, 'store']);
    Route::put('/update/{id}', [UsuariosController::class, 'update']);
    Route::delete('/destroy/{id}', [UsuariosController::class, 'destroy']);
});
