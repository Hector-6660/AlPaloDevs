<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'franquicia_id',
    ];

    public function franquicia() {
        return $this->belongsTo('App\Models\Franquicia');
    }
}
