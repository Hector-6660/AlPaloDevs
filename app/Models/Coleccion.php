<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'usuario_id',
        'imagen',
    ];

    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function juegos() {
        return $this->belongsToMany('App\Models\Juego');
        // return $this->hasMany('App\Models\Juego');
    }
}
