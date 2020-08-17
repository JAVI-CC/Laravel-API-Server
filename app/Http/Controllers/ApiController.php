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

        $validator = $this->api->validation($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $juego = Api::create($request->all());
            return response()->json(['success' => 'Se ha añadido correctamente el juego: ' . $juego->nombre]);
        }
    }

    public function get($id)
    {
        $juego = Api::find($id);
        $juego = $this->api->exists_id($juego);
        return $juego;
    }

    public function edit($id, Request $request)
    {
        $validator = $this->api->validation($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $id_juego = $this->get($id);
            $juego = $this->api->exists_id_update($id_juego, $request);
            return $juego;
        }
    }

    public function delete($id)
    {
        $id_juego = $this->get($id);
        $juego = $this->api->exists_id_delete($id_juego);
        return $juego;
    }
}
