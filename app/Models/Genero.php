<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   @OA\Xml(name="Genero"),
 *   @OA\Property(property="nombre", description="Nombre del genero", type="string", example="Rpg de Acción"),
 *   @OA\Property(property="slug", type="string", description="Url amigable del nombre del genero", example="rpg-de-accion")
 * )
 **/
class Genero extends Base
{
    //Relacion de muchos a muchos polimorfica
    public function juegables()
    {
        return $this->morphToMany(Juego::class, 'juegable');
    }

}
