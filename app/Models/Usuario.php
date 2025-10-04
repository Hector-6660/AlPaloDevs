<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'nick',
        'email',
        'rol',
        'foto_perfil',
    ];

    protected $hidden = [
        'password',
    ];

    public function opiniones() {
        return $this->hasMany('App\Models\Opinion');
    }

    public function coleccion() {
        return $this->hasOne('App\Models\Coleccion');
    }
}
