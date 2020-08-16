<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Api extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha');

    public function validation($request) {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255',
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required',
        ]);   

        return $validator; 
    }
}
