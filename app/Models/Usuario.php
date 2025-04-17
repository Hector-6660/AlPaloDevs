<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'nick',
        'email',
        'password',
        'rol',
    ];

    public function opiniones() {
        return $this->hasMany('App\Models\Opinion');
    }

    public function coleccion() {
        return $this->hasOne('App\Models\Coleccion');
    }
}
