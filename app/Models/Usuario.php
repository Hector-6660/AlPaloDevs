<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'nick',
        'email',
        'password',
        'rol',
        'foto_perfil',
    ];

    // Para ocultar los atributos en los JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function opiniones() {
        return $this->hasMany('App\Models\Opinion');
    }

    public function coleccion() {
        return $this->hasOne('App\Models\Coleccion');
    }
}
