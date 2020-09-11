<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getAll()
    {
        $juegos = Api::orderBy('id', 'DESC')->get();
        return $juegos;
    }

    public function add(Request $request)
    {

        $validator = $this->api->validation_add($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $juego = $this->api->add_juego($request);
            return response()->json(['success' => 'Se ha añadido correctamente el juego: ' . $juego]);
        }
    }

    public function get($slug)
    {
        $juego = Api::WHERE('slug', $slug)->first();
        $juego = $this->api->exists_slug($juego);
        return $juego;
    }

    public function edit($slug, Request $request)
    {
        $juego = $this->get($slug);
        if (isset($juego->original['error'])) {
            return $juego;
        } else {
            $validator = $this->api->validation_update($request, $juego->nombre);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            } else {
                $juego = $this->api->exists_id_update($juego, $request);
                return $juego;
            }
        }
    }

    public function delete($slug)
    {
        $id_juego = $this->get($slug);
        $juego = $this->api->exists_id_delete($id_juego);
        return $juego;
    }

    public function filter(Request $request)
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
