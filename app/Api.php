<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Api extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha');

    public function validation($request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255|unique:juegos',
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required',
        ]);

        return $validator;
    }

    public function exists_id($id_juego)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            return $id_juego;
        }
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->fill($request->all())->save();
            return response()->json(['success' => 'Se ha modificado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function exists_id_delete($id_juego)
    {
        return $id_juego;
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            return response()->json(['success' => 'Se ha eliminado correctamente el juego: ' . $id_juego->nombre]);
        }
    }
}
