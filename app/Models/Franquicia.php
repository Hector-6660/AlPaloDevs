<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franquicia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'logo',
    ];

    public function juegos() {
        return $this->hasMany('App\Models\Juego');
    }

    public function personajes() {
        return $this->hasMany('App\Models\Personaje');
    }
}
