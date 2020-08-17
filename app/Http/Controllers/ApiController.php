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
            return response()->json(['success' => 'Se ha añadido correctamente el juego ' . $juego->nombre]);
        }
    }

    public function get($id)
    {
        $juego = Api::find($id);
        return $juego;
    }

    public function edit($id, Request $request)
    {

        $validator = $this->api->validation($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $juego = $this->get($id);
            $juego->fill($request->all())->save();
            return response()->json(['success' => 'Se ha modificado correctamente el juego ' . $juego->nombre]);
        }
    }

    public function delete($id)
    {
        $juego = $this->get($id);
        $juego->delete();
        return response()->json(['success' => 'Se ha eliminado correctamente el juego ' . $juego->nombre]);
    }
}
