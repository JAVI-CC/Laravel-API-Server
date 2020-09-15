<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ApiCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nombre'            => $this->nombre,
            'descripcion'       => $this->descripcion,
            'desarrolladora'    => $this->desarrolladora,
            'fecha'             => $this->fecha,
            'slug'              => $this->slug,
        ];
    }
}
