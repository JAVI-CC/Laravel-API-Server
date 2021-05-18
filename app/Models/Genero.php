<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Base
{
    //Relacion de muchos a muchos polimorfica
    public function juegables()
    {
        return $this->morphToMany(Juego::class, 'juegable');
    }
}
