<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha');
}
