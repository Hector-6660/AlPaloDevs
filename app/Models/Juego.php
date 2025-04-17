<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_lanzamiento',
        'plataforma',
        'genero',
        'autor'
    ];

    public function colecciones() {
        return $this->belongsToMany('App\Models\Coleccion');
    }

    public function opiniones() {
        return $this->hasMany('App\Models\Opinion');
    }
}
