<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JuegoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    
        return [
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "desarrolladora" => new DesarrolladoraResource($this->findByIdDesarrolladora($this->desarrolladora)),
            "fecha" => $this->fecha,
            "slug" => $this->slug,
            "imagen" => $this->url_imagen,
        ];
    }
}
