<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_lanzamiento',
        'plataforma',
        'genero',
        'autor',
        'imagen',
        'franquicia_id',
    ];

    public function colecciones() {
        return $this->belongsToMany('App\Models\Coleccion');
    }

    public function opiniones() {
        return $this->hasMany('App\Models\Opinion');
    }

    public function franquicia() {
        return $this->belongsTo('App\Models\Franquicia');
    }

}
