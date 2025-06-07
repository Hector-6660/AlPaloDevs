<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JuegoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_lanzamiento' => $this->fecha_lanzamiento,
            'plataforma' => $this->plataforma,
            'genero' => $this->genero,
            'autor' => $this->autor,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}