<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'puntuacion',
        'fecha_creacion',
        'usuario_id',
        'juego_id'
    ];

    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function juego() {
        return $this->belongsTo('App\Models\Juego');
    }
}
