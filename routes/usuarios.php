<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::group(['prefix' => 'usuarios'], function(){
    Route::get('/', [UsuarioController::class, 'index']);
    Route::get('/show/{id}', [UsuarioController::class, 'show']);
    Route::post('/store', [UsuarioController::class, 'store']);
    Route::put('/update/{id}', [UsuarioController::class, 'update']);
    Route::delete('/destroy/{id}', [UsuarioController::class, 'destroy']);
});