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

    public function index()
    {
        $juegos = Api::orderBy('id', 'DESC')->get();
        return $juegos;
    }

    public function store(Request $request)
    {

        $validator = $this->api->validation_add($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $juego = $this->api->add_juego($request);
            return response()->json(['success' => 'Se ha añadido correctamente el juego: ' . $juego]);
        }
    }

    public function show($slug)
    {
        $juego = Api::WHERE('slug', $slug)->first();
        $juego = $this->api->exists_slug($juego);
        return $juego;
    }

    public function update($slug, Request $request)
    {
        $juego = $this->show($slug);
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
        $id_juego = $this->show($slug);
        $juego = $this->api->exists_id_delete($id_juego);
        return $juego;
    }

    public function filter(Request $request)
    {
        $juegos = $this->api->search($request);
        return $juegos;
    }
}