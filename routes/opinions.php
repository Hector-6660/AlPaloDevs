<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpinionesController;

Route::group(['prefix' => 'opiniones'], function(){
    Route::get('/', [OpinionesController::class, 'index']);
    Route::get('/show/{id}', [OpinionesController::class, 'show']);
    Route::post('/store', [OpinionesController::class, 'store']);
    Route::put('/update/{id}', [OpinionesController::class, 'update']);
    Route::delete('/destroy/{id}', [OpinionesController::class, 'destroy']);
});