<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Api extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $hidden = array('id');
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha', 'slug');

    protected function convert_url($txt)
    {
        $txt = substr($txt, 0, 140);
        $txt = strtr($txt, " _ÀÁÂÃÄÅÆàáâãäåæÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñÞßÿý",  "--aaaaaaaaaaaaaaoooooooooooooeeeeeeeeecceiiiiiiiiuuuuuuuunntsyy");
        $txt = strtolower($txt);
        $txt = preg_replace("/[^a-z0-9\-.]/", "", $txt);
        return str_replace("--", "-", $txt);
    }

    public function validation_add($request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255|unique:juegos',
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required',
        ]);

        return $validator;
    }

    public function validation_update($request, $nombre)
    {

        if ($request->nombre == $nombre) {
            $exp = '';
        } else {
            $exp = '|unique:juegos';
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255' . $exp,
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required',
        ]);

        return $validator;
    }

    public function exists_slug($id_juego)
    {
        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            return $id_juego;
        }
    }

    public function add_juego($request)
    {
        $slug = API::convert_url($request->nombre);
        $request->request->add(['slug' => $slug]);
        API::create(array_merge($request->all()));
        return $request->nombre;
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = API::convert_url($request->nombre);
            $request->request->add(['slug' => $slug]);
            $id_juego->fill($request->all())->save();
            return response()->json(['success' => 'Se ha modificado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function exists_id_delete($id_juego)
    {
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            return response()->json(['success' => 'Se ha eliminado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function search($request)
    {
        if ($request->search == "" || $request->search == NULL) {
            $request->search = '';
        }

        if ($request->filter == "" || $request->filter == NULL) {
            $request->filter = 'id';
        }

        if ($request->order == "" || $request->order == NULL) {
            $request->order = 'DESC';
        }

        $juegos = Api::WHERE('nombre', 'ILIKE', '%' . $request->search . '%')
            ->OrWhere('desarrolladora', 'ILIKE', '%' . $request->search . '%')
            ->OrWhere('descripcion', 'ILIKE', '%' . $request->search . '%')
            ->OrWhere('fecha', 'ILIKE', '%' . $request->search . '%')
            ->orderBy($request->filter, $request->order)->get();


        if ($juegos == '[]') {
            return response()->json(['error' => 'La búsqueda de ' . $request->search . ' no obtuvo ningún resultado']);
        } else {
            return $juegos;
        }
    }
}
