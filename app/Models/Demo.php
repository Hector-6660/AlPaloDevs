<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'mainScript',
        'juego_id',
    ];

    public function juego() {
        return $this->belongsTo('App\Models\Juego');
    }
}
