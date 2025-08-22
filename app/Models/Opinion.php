<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'puntuacion',
        'usuario_id',
        'juego_id'
    ];

    protected $casts = [
        'puntuacion' => 'integer',
    ];

    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function juego() {
        return $this->belongsTo('App\Models\Juego');
    }
}
